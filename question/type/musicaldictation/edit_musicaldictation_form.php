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
 * Defines the editing form for the musicaldictation question type.
 *
 * @package    qtype
 * @subpackage musicaldictation
 * @copyright  2020 Jeffrey Cann
 */


defined('MOODLE_INTERNAL') || die();


/**
 * Musical Dictation question editing form definition.
 */
class qtype_musicaldictation_edit_form extends question_edit_form {

    protected function definition_inner($mform) {

        $mform->addElement('filepicker', 'audio_file_url', "Audio file", null, array('maxbytes' => 100000000, 'accepted_types' => array("MP3", "M4A")));
        $mform->addElement('textarea', 'initial_score', 'Initial score setup', '{}');
        $mform->addElement('select',   'canvas_height', 'Canvas height', array(200, 300, 450, 550));
        $mform->addElement('select',   'canvas_width', 'Canvas width', array(600, 800, 1000, 1200));
        $mform->addElement('select',   'voice_count', 'Number of voices', array(1, 2, 3, 4));
        $mform->addElement('select',   'can_change_key', 'Can change key', array('No', 'Yes'));
        $mform->addElement('select',   'can_change_time', 'Can change timing', array('No', 'Yes'));
        $mform->addElement('select',   'max_play_count', 'Maximum number of plays', array("Unlimited", 1, 2, 3, 4, 5, 6, 7, 8));
        $mform->addElement('static',   'answersinstruct', get_string('correctanswers', 'qtype_musicaldictation'), get_string('filloutoneanswer', 'qtype_musicaldictation'));

        $mform->closeHeaderBefore('answersinstruct');

        $this->add_per_answer_fields($mform, get_string('answerno', 'qtype_musicaldictation', '{no}'), question_bank::fraction_options());

        $this->add_interactive_settings();
    }

    protected function get_more_choices_string() {
        return get_string('addmoreanswerblanks', 'qtype_musicaldictation');
    }

    protected function data_preprocessing($question) {
        $question = parent::data_preprocessing($question);
        $question = $this->data_preprocessing_answers($question);
        $question = $this->data_preprocessing_hints($question);

        return $question;
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);
        $answers = $data['answer'];
        $answercount = 0;
        $maxgrade = false;

        foreach ($answers as $key => $answer) {
            $trimmedanswer = trim($answer);
            if ($trimmedanswer !== '') {
                $answercount++;
                if ($data['fraction'][$key] == 1) {
                    $maxgrade = true;
                }
            } else if ($data['fraction'][$key] != 0 || !html_is_blank($data['feedback'][$key]['text'])) {
                $errors["answeroptions[{$key}]"] = get_string('answermustbegiven', 'qtype_musicaldictation');
                $answercount++;
            }
        }

        if ($answercount==0) {
            $errors['answeroptions[0]'] = get_string('notenoughanswers', 'qtype_musicaldictation', 1);
        }

        if ($maxgrade == false) {
            $errors['answeroptions[0]'] = get_string('fractionsnomax', 'question');
        }

        return $errors;
    }

    public function qtype() {
        return 'musicaldictation';
    }
}
