<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Musical Dictation question renderer class.
 *
 * @package    qtype
 * @subpackage musicaldictation
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * Generates the output for musical Dictation questions.
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_musicaldictation_renderer extends qtype_renderer {
    public function formulation_and_controls(question_attempt $qa,
            question_display_options $options) {
        global $DB;

        $question = $qa->get_question();
        $currentanswer = $qa->get_last_qt_var('answer');

        $this->page->requires->js('/question/type/musicaldictation/amd/app.054211d9.js');

        $inputname = $qa->get_qt_field_name('answer');
        $inputattributes = array(
            'type' => 'text',
            'name' => $inputname,
            'value' => $currentanswer,
            'id' => $inputname,
            'size' => 80,
            'class' => 'form-control d-inline',
        );

        if ($options->readonly) {
            $inputattributes['readonly'] = 'readonly';
        }

        $feedbackimg = '';
        if ($options->correctness) {
            $answer = $question->get_matching_answer(array('answer' => $currentanswer));
            if ($answer) {
                $fraction = $answer->fraction;
            } else {
                $fraction = 0;
            }
            $inputattributes['class'] .= ' ' . $this->feedback_class($fraction);
            $feedbackimg = $this->feedback_image($fraction);
        }

        $questiontext = $question->format_questiontext($qa);
        $placeholder = false;
        if (preg_match('/_____+/', $questiontext, $matches)) {
            $placeholder = $matches[0];
            $inputattributes['size'] = round(strlen($placeholder) * 1.1);
        }
        $input = html_writer::empty_tag('input', $inputattributes) . $feedbackimg;

        if ($placeholder) {
            $inputinplace = html_writer::tag('label', get_string('answer'), array('for' => $inputattributes['id'], 'class' => 'accesshide'));
            $inputinplace .= $input;
            $questiontext = substr_replace($questiontext, $inputinplace, strpos($questiontext, $placeholder), strlen($placeholder));
        }

        // generate the URL for the audio file
        $fileRecord = $DB->get_record_select("files", "itemid = {$question->audio_file_url} and filesize > 0");
        $audiourl = file_rewrite_pluginfile_urls("@@PLUGINFILE@@{$fileRecord->filepath}/{$fileRecord->filename}", $fileRecord->filearea == 'draft' ? 'draftfile.php' : 'pluginfile.php',
            $fileRecord->contextid, $fileRecord->component, $fileRecord->filearea, $question->audio_file_url);

        var_dump($currentanswer);

        // these are all the data attributes passed to the Vue app
        $appattrs = array(
            'id' => 'app',
            'data-answer-element-id' => $inputname,
            'data-context-id' =>  $this->context->id,
            'data-audio-file-url-raw' =>  $audiourl,
            'data-audio-file-url' =>  base64_encode($audiourl),
            'data-initial-score' =>   base64_encode($currentanswer ? $currentanswer : $question->initial_score),
            'data-canvas-height' =>   array(200, 300, 450, 550)[$question->canvas_height],
            'data-canvas-width' =>    array(600, 800, 1000, 1200)[$question->canvas_width],
            'data-voice-count' =>     $question->voice_count + 1,
            'data-can-change-key' =>  $question->can_change_key,
            'data-can-change-time' => $question->can_change_time,
            'data-max-play-count' =>  $question->max_play_count,
        );

        $result = html_writer::tag('div', null, $appattrs);
        $result .= html_writer::tag('div', $questiontext, array('class' => 'qtext'));

        if (!$placeholder) {
            $result .= html_writer::start_tag('div', array('class' => 'ablock form-inline'));
            $result .= html_writer::tag('label', get_string('answer', 'qtype_musicaldictation', html_writer::tag('span', $input, array('class' => 'answer'))), array('for' => $inputattributes['id']));
            $result .= html_writer::end_tag('div');
        }

        if ($qa->get_state() == question_state::$invalid) {
            $result .= html_writer::nonempty_tag('div', $question->get_validation_error(array('answer' => $currentanswer)), array('class' => 'validationerror'));
        }

        return $result;
    }

    public function specific_feedback(question_attempt $qa) {
        $question = $qa->get_question();

        $answer = $question->get_matching_answer(array('answer' => $qa->get_last_qt_var('answer')));
        if (!$answer || !$answer->feedback) {
            return '';
        }

        return $question->format_text($answer->feedback, $answer->feedbackformat,
                $qa, 'question', 'answerfeedback', $answer->id);
    }

    public function correct_response(question_attempt $qa) {
        $question = $qa->get_question();

        $answer = $question->get_matching_answer($question->get_correct_response());
        if (!$answer) {
            return '';
        }

        return get_string('correctansweris', 'qtype_musicaldictation',
                s($question->clean_response($answer->answer)));
    }
}
