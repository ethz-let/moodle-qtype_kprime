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
 * Unit tests for qtype_kprime question definition class.
 *
 * @package     qtype_kprime
 * @author      Amr Hourani (amr.hourani@id.ethz.ch)
 * @author      Martin Hanusch (martin.hanusch@let.ethz.ch)
 * @author      Jürgen Zimmer (juergen.zimmer@edaktik.at)
 * @author      Andreas Hruska (andreas.hruska@edaktik.at)
 * @copyright   2016 ETHZ {@link http://ethz.ch/}
 * @copyright   2014 eDaktik GmbH {@link http://www.edaktik.at}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace qtype_kprime;

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/question/engine/lib.php');
require_once($CFG->dirroot . '/question/type/kprime/tests/helper.php');
require_once($CFG->dirroot . '/question/engine/tests/helpers.php');

/**
 * Unit tests for qtype_kprime question definition class.
 *
 * @copyright   2016 ETHZ {@link http://ethz.ch/}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @group       qtype_kprime
 */
final class walkthrough_test extends \qbehaviour_walkthrough_test_base {

    /**
     * (non-PHPdoc)
     * @param int $index
     * @param int $value
     * @param bool $enabled
     * @param bool $checked
     * @return array
     */
    public function get_contains_kprime_radio_expectation($index, $value, $enabled = null, $checked = null) {
        return $this->get_contains_radio_expectation([
            'name' => $this->quba->get_field_prefix($this->slot) .  "option" .  $index,
            'value' => $value,
        ], $enabled, $checked);
    }

    /**
     * Makes a qtype_kprime question.
     * @return qtype_kprime
     */
    public function make_a_kprime_question() {
        \question_bank::load_question_definition_classes('kprime');
        $kprime = new \qtype_kprime_question();
        \test_question_maker::initialise_a_question($kprime);
        $kprime->name = 'Kprime Question';
        $kprime->questiontext = 'the right choices are option 1 and option 2';
        $kprime->generalfeedback = 'You should do this and that';
        $kprime->qtype = \question_bank::get_qtype('kprime');
        $kprime->options = new \stdClass();
        $kprime->options->shuffleanswers = 1;
        $kprime->status = \core_question\local\bank\question_version_status::QUESTION_STATUS_READY;
        $kprime->answernumbering = 'abc';
        $kprime->scoringmethod = "subpoints";
        $kprime->rows = [
            1 => (object) [
                "id" => 1,
                "questionid" => 1,
                "number" => 1,
                "optiontext" => "option text 1",
                "optiontextformat" => 1,
                "optionfeedback" => "feedback to option 1",
                "optionfeedbackformat" => 1,
            ],
            2 => (object) [
                "id" => 2,
                "questionid" => 1,
                "number" => 2,
                "optiontext" => "option text 2",
                "optiontextformat" => 1,
                "optionfeedback" => "feedback to option 2",
                "optionfeedbackformat" => 1,
            ],
            3 => (object) [
                "id" => 3,
                "questionid" => 1,
                "number" => 3,
                "optiontext" => "option text 3",
                "optiontextformat" => 1,
                "optionfeedback" => "feedback to option 3",
                "optionfeedbackformat" => 1,
            ],
            4 => (object) [
                "id" => 4,
                "questionid" => 1,
                "number" => 4,
                "optiontext" => "option text 4",
                "optiontextformat" => 1,
                "optionfeedback" => "feedback to option 4",
                "optionfeedbackformat" => 1,
            ],
        ];
        $kprime->columns = [
            1 => (object) ["id" => 1, "questionid" => 1, "number" => 1, "responsetext" => "True", "responsetextformat" => 0],
            2 => (object) ["id" => 2, "questionid" => 1, "number" => 2, "responsetext" => "False", "responsetextformat" => 0],
        ];
        $kprime->weights = [
            1 => [
                1 => (object)  ["id" => 1, "questionid" => 1, "rownumber" => 1, "columnnumber" => 1, "weight" => 1.000],
                2 => (object)  ["id" => 2, "questionid" => 1, "rownumber" => 1, "columnnumber" => 2, "weight" => 0.000],
            ],
            2 => [
                1 => (object)  ["id" => 3, "questionid" => 1, "rownumber" => 2, "columnnumber" => 1, "weight" => 1.000],
                2 => (object)  ["id" => 4, "questionid" => 1, "rownumber" => 2, "columnnumber" => 2, "weight" => 0.000],
            ],
            3 => [
                1 => (object)  ["id" => 5, "questionid" => 1, "rownumber" => 3, "columnnumber" => 1, "weight" => 0.000],
                2 => (object)  ["id" => 6, "questionid" => 1, "rownumber" => 3, "columnnumber" => 2, "weight" => 1.000],
            ],
            4 => [
                1 => (object)  ["id" => 7, "questionid" => 1, "rownumber" => 4, "columnnumber" => 1, "weight" => 0.000],
                2 => (object)  ["id" => 8, "questionid" => 1, "rownumber" => 4, "columnnumber" => 2, "weight" => 1.000],
            ],
        ];
        return $kprime;
    }

    /**
     * Test deferredfeedback_feedback_kprime
     *
     * @covers ::question_behaviours
     */
    public function test_deferredfeedback_feedback_kprime(): void {
        $kprime = $this->make_a_kprime_question();
        $this->start_attempt_at_question($kprime, 'deferredfeedback', 1);
        $this->process_submission(["option0" => 1, "option1" => 1, "option2" => 2, "option3" => 2]);
        $this->check_current_state(\question_state::$complete);
        $this->check_current_mark(null);
        $this->check_current_output(
            $this->get_contains_kprime_radio_expectation(0, 1, true, true),
            $this->get_contains_kprime_radio_expectation(0, 2, true, false),
            $this->get_contains_kprime_radio_expectation(1, 1, true, true),
            $this->get_contains_kprime_radio_expectation(1, 2, true, false),
            $this->get_contains_kprime_radio_expectation(2, 1, true, false),
            $this->get_contains_kprime_radio_expectation(2, 2, true, true),
            $this->get_contains_kprime_radio_expectation(3, 1, true, false),
            $this->get_contains_kprime_radio_expectation(3, 2, true, true),
            $this->get_does_not_contain_correctness_expectation(),
            $this->get_does_not_contain_feedback_expectation());
        $this->quba->finish_all_questions();
        $this->check_current_state(\question_state::$gradedright);
        $this->check_current_mark(1);
        $this->check_current_output(
            $this->get_contains_kprime_radio_expectation(0, 1, false, true),
            $this->get_contains_kprime_radio_expectation(1, 1, false, true),
            $this->get_contains_kprime_radio_expectation(2, 2, false, true),
            $this->get_contains_kprime_radio_expectation(3, 2, false, true),
            $this->get_contains_correct_expectation(),
            new \question_pattern_expectation('/name=\".*1_option0\".*value=\"1\".*checked=\"checked\"/'),
            new \question_pattern_expectation('/name=\".*1_option1\".*value=\"1\".*checked=\"checked\"/'),
            new \question_pattern_expectation('/name=\".*1_option2\".*value=\"2\".*checked=\"checked\"/'),
            new \question_pattern_expectation('/name=\".*1_option3\".*value=\"2\".*checked=\"checked\"/')
        );
    }
}
