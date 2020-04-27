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
 * Rules controller.
 *
 * @package    local_xp
 * @copyright  2017 Frédéric Massart
 * @author     Frédéric Massart <fred@branchup.tech>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_xp\local\controller;
defined('MOODLE_INTERNAL') || die();


/**
 * Rules controller class.
 *
 * @package    local_xp
 * @copyright  2017 Frédéric Massart
 * @author     Frédéric Massart <fred@branchup.tech>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class rules_controller extends \block_xp\local\controller\rules_controller {

    protected function get_available_rules() {
        $rules = parent::get_available_rules();
        $rules[] = (object) [
            'name' => get_string('activitycompletion', 'completion'),
            'rule' => new \local_xp\local\rule\activity_completion(),
        ];
        $rules[] = (object) [
            'name' => get_string('coursecompletion', 'completion'),
            'rule' => new \local_xp\local\rule\course_completion(),
        ];
        // This does not work as intended just yet, needs more work!
        // $rules[] = (object) [
        //     'name' => get_string('ruleusergraded', 'local_xp'),
        //     'rule' => new \local_xp\local\rule\user_graded(),
        // ];
        return $rules;
    }

}
