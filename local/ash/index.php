<?php



require_once('../../config.php');

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/ash/index.php'));
$PAGE->set_pagelayout('standard');
$PAGE->set_title($SITE->fullname);
$PAGE->set_heading(get_string('pluginname', 'local_ash'));



echo $OUTPUT->header();

echo $OUTPUT->footer();