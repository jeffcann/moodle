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
<<<<<<< HEAD:mod/checklist/db/events.php
 * Update checklists when events occur
 *
 * @package   mod_checklist
 * @copyright 2015 Davo Smith, Synergy Learning
=======
 * Version details
 *
 * @package   contenttype_h5p
 * @copyright  2020 Amaia Anabitarte <amaia@moodle.com>
>>>>>>> 3e78b603a558ddd8216f0612a767cc75a8c8dd13:contentbank/contenttype/h5p/version.php
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

<<<<<<< HEAD:mod/checklist/db/events.php
$observers = array(
    array(
        'eventname' => '*',
        'callback' => '\mod_checklist\local\autoupdate::update_from_event'
    )
);
=======
$plugin->version   = 2020061500;         // The current plugin version (Date: YYYYMMDDXX)
$plugin->requires  = 2020060900;         // Requires this Moodle version
$plugin->component = 'contenttype_h5p'; // Full name of the plugin (used for diagnostics).
>>>>>>> 3e78b603a558ddd8216f0612a767cc75a8c8dd13:contentbank/contenttype/h5p/version.php
