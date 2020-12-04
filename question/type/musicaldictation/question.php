<?php
/**
 * Musical Dictation question definition class.
 *
 * @package    qtype
 * @subpackage musicaldictation
 * @copyright  2020 M.A.T.T.
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/questionbase.php');

/**
 * Represents a musical Dictation question.
 * @copyright  2020 M.A.T.T.
 */
class qtype_musicaldictation_question
        extends question_graded_by_strategy
        implements question_response_answer_comparer {

    /** @var boolean whether answers should be graded case-sensitively. */
    public $usecase;

    /** @var array of question_answer. */
    public $answers = array();

    public function __construct() {
        parent::__construct(new question_first_matching_answer_grading_strategy($this));
    }

    public function get_expected_data() {
        return array('answer' => PARAM_RAW_TRIMMED);
    }

    public function summarise_response(array $response) {
        if (isset($response['answer'])) {
            return $response['answer'];
        } else {
            return null;
        }
    }

    public function un_summarise_response(string $summary) {
        if (!empty($summary)) {
            return ['answer' => $summary];
        } else {
            return [];
        }
    }

    public function is_complete_response(array $response) {
        return array_key_exists('answer', $response) && ($response['answer'] || $response['answer'] === '0');
    }

    public function get_validation_error(array $response) {
        if ($this->is_gradable_response($response)) {
            return '';
        }

        return get_string('pleaseenterananswer', 'qtype_musicaldictation');
    }

    public function is_same_response(array $prevresponse, array $newresponse) {
        return question_utils::arrays_same_at_key_missing_is_blank($prevresponse, $newresponse, 'answer');
    }

    public function get_answers() {
        return $this->answers;
    }

    public function format_generalfeedback($qa)
    {
        $response = json_decode($qa->get_response_summary());
        $answer = json_decode($qa->get_right_answer_summary());
        $errors = $this->find_errors($response, $answer);
        return (count($errors) === 0) ? "" : implode("<br/>", $errors);
    }

    protected function find_errors($response, $answer) {
        $errors = [];

        // timing sig is wrong
        if($response->time !== $answer->time) {
            array_push($errors, 'Incorrect timing signature');
        }

        // key sig is wrong
        if($response->key !== $answer->key) {
            array_push($errors, 'Incorrect key signature');
        }

        // fail on the first error
        foreach ($answer->staves as $staveidx => $stave) {
            $responsestave = $response->staves[$staveidx];
            foreach($stave->voices as $voiceidx => $voice) {
                $responsevoice = $responsestave->voices[$voiceidx];
                foreach($voice->notes as $noteidx => $note) {
                    $responsenote = $responsevoice->notes[$noteidx];

                    // check note length (rhythm)
                    if($responsenote->duration !== $note->duration) {
                        array_push($errors, "One or more mistakes with rhythm and/or pitch (check duration @ {$staveidx}/{$voiceidx}/{$noteidx})");
                        break;
                    }

                    // if the note is not a rest or bar, check the pitch
                    $is_rest = strpos($responsenote->duration, 'r') > 0;
                    $is_bar = !!$responsenote->bar;
                    if(!$is_bar && !$is_rest) {
                        if($responsenote->keys[0] !== $note->keys[0]) {
                            array_push($errors, "One or more mistakes with rhythm and/or pitch (check pitch @ {$staveidx}/{$voiceidx}/{$noteidx})");
                            break;
                        }

                        if($responsenote->accidental !== $note->accidental) {
                            array_push($errors, "One or more mistakes with rhythm and/or pitch (check accidental @ {$staveidx}/{$voiceidx}/{$noteidx})");
                            break;
                        }
                    }
                }

                if(count($voice->ties) !== count($responsevoice->ties)) {
                    array_push($errors, "The number of ties is incorrect");
                } else {
                    foreach ($voice->ties as $tieidx => $tie) {
                        $responsetie = $responsevoice->ties[$tieidx];
                        if ($tie->startNoteIdx !== $responsetie->startNoteIdx || $tie->endNoteIdx !== $responsetie->endNoteIdx) {
                            array_push($errors, "There is a mistake with the location of one or more ties");
                        }
                    }
                }
            }
        }

        return $errors;
    }

    public function compare_response_with_answer(array $responsejson, question_answer $answerjson)
    {
        if (!array_key_exists('answer', $responsejson) || is_null($responsejson['answer'])) {
            return false;
        }

        $response = json_decode($responsejson['answer']);
        $answer = json_decode($answerjson->answer);
        $errors = $this->find_errors($response, $answer);

        return count($errors) === 0;
    }

    public function check_file_access($qa, $options, $component, $filearea, $args, $forcedownload) {
        if ($component == 'question' && $filearea == 'answerfeedback') {
            $currentanswer = $qa->get_last_qt_var('answer');
            $answer = $this->get_matching_answer(array('answer' => $currentanswer));
            $answerid = reset($args); // Itemid is answer id.
            return $options->feedback && $answer && $answerid == $answer->id;
        } else if ($component == 'question' && $filearea == 'hint') {
            return $this->check_hint_file_access($qa, $options, $args);
        } else {
            return parent::check_file_access($qa, $options, $component, $filearea, $args, $forcedownload);
        }
    }
}
