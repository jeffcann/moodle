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
<<<<<<< HEAD:blocks/participants/db/access.php
 * Participants block caps.
 *
 * @package    block_participants
 * @copyright  Mark Nelson <markn@moodle.com>
=======
 * Version details for component 'tool_licensemanager'.
 *
 * @package    tool_licensemanager
 * @copyright  Tom Dickman <tomdickman@catalyst-au.net>
>>>>>>> 3e78b603a558ddd8216f0612a767cc75a8c8dd13:admin/tool/licensemanager/version.php
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

<<<<<<< HEAD:blocks/participants/db/access.php
$capabilities = array(

    'block/participants:addinstance' => array(
        'riskbitmask' => RISK_SPAM | RISK_XSS,

        'captype' => 'write',
        'contextlevel' => CONTEXT_BLOCK,
        'archetypes' => array(
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),

        'clonepermissionsfrom' => 'moodle/site:manageblocks'
    ),
);
=======
$plugin->version   = 2020061500;
$plugin->requires  = 2020060900;         // Requires this Moodle version.
$plugin->component = 'tool_licensemanager';

$plugin->maturity = MATURITY_STABLE;
>>>>>>> 3e78b603a558ddd8216f0612a767cc75a8c8dd13:admin/tool/licensemanager/version.php
