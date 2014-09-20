<?php
unset($CFG);

global $CFG;
$CFG = new stdClass();
$CFG->dirroot = 'http://localhost/dietplanner';
$CFG->templatedir = $CFG->dirroot.'/templates/initial/';
?>
