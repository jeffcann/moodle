<?php
defined('MOODLE_INTERNAL') || die();

/**
 * Upgrade code for the musical dictation question type.
 * @param int $oldversion the version we are upgrading from.
 */
function xmldb_qtype_musicaldictation_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager();
    $newversion = 2020102701;

    if ($oldversion < 2020072702) {

        $table = new xmldb_table('qtype_musicaldict_options');
        $field = new xmldb_field('audio_file_url', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);

        // Conditionally launch add field.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        upgrade_plugin_savepoint(true, $newversion, 'qtype', 'musicaldictation');
    }

    if ($oldversion < 2020102701) {

        $table = new xmldb_table('qtype_musicaldict_options');

        $newfields = array('hide_audio_player','hide_time_signature','hide_bars');
        foreach ($newfields as $newfield) {
            $field = new xmldb_field($newfield, XMLDB_TYPE_INTEGER, 1, true, XMLDB_NOTNULL, null, 0);

            // Conditionally launch add field.
            if (!$dbman->field_exists($table, $field)) {
                $dbman->add_field($table, $field);
            }
        }
        unset($newfield);

        upgrade_plugin_savepoint(true, $newversion, 'qtype', 'musicaldictation');
    }

    return true;
}

