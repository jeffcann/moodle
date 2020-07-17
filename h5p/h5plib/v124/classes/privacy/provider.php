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
<<<<<<< HEAD:blocks/participants/classes/privacy/provider.php
 * Privacy Subsystem implementation for block_participants.
 *
 * @package    block_participants
 * @copyright  2018 Zig Tan <zig@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_participants\privacy;
=======
 * Privacy provider implementation for the version 1.24 of the H5P library.
 *
 * @package    h5plib_v124
 * @copyright  2020 Sara Arjona <sara@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace h5plib_v124\privacy;
>>>>>>> 3e78b603a558ddd8216f0612a767cc75a8c8dd13:h5p/h5plib/v124/classes/privacy/provider.php

defined('MOODLE_INTERNAL') || die();

/**
<<<<<<< HEAD:blocks/participants/classes/privacy/provider.php
 * Privacy Subsystem for block_participants implementing null_provider.
 *
 * @copyright  2018 Zig Tan <zig@moodle.com>
=======
 * Privacy provider implementation for the version 1.24 of the H5P library.
 *
 * @copyright  2020 Sara Arjona <sara@moodle.com>
>>>>>>> 3e78b603a558ddd8216f0612a767cc75a8c8dd13:h5p/h5plib/v124/classes/privacy/provider.php
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\null_provider {
    /**
     * Get the language string identifier with the component's language
     * file to explain why this plugin stores no data.
     *
     * @return  string
     */
    public static function get_reason() : string {
        return 'privacy:metadata';
    }
}
