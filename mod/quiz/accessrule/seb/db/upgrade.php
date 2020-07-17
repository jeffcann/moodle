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
<<<<<<< HEAD:blocks/remuiblck/version.php
 * Edwiser RemUI.
 *
 * @package    block_remuiblck
 * @copyright  2019 WisdmLabs
=======
 * Upgrade script for plugin.
 *
 * @package    quizaccess_seb
 * @author     Andrew Madden <andrewmadden@catalyst-au.net>
 * @copyright  2019 Catalyst IT
>>>>>>> 3e78b603a558ddd8216f0612a767cc75a8c8dd13:mod/quiz/accessrule/seb/db/upgrade.php
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

<<<<<<< HEAD:blocks/remuiblck/version.php
$plugin->version   = 2020021100;
$plugin->requires  = 2017111300;
$plugin->maturity  = MATURITY_STABLE; // This version's maturity level.
$plugin->release   = '1.0.12';
$plugin->component = 'block_remuiblck';

// ********************* CHECK THIS PLUGIN DEPENDECIES******************************//

// $plugin->dependencies = array(
// 'theme_remui' => ANY_VERSION,   // The Foo activity must be present (any version).
// 'enrol_bar' => 2014020300, // The Bar enrolment plugin version 2014020300 or higher must be present.
// );
=======
require_once($CFG->dirroot  . '/mod/quiz/accessrule/seb/lib.php');

/**
 * Function to upgrade quizaccess_seb plugin.
 *
 * @param int $oldversion The version we are upgrading from.
 * @return bool Result.
 */
function xmldb_quizaccess_seb_upgrade($oldversion) {
    global $DB;
    $dbman = $DB->get_manager();

    // Automatically generated Moodle v3.9.0 release upgrade line.
    // Put any upgrade step following this.

    return true;
}
>>>>>>> 3e78b603a558ddd8216f0612a767cc75a8c8dd13:mod/quiz/accessrule/seb/db/upgrade.php
