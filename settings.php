<?php
unset($CFG);
global $CFG;
$CFG = new stdClass();
$CFG->dirroot = 'http://localhost/dietplanner';
$CFG->templatedir = $CFG->dirroot.'/templates/';
$CFG->dircss = $CFG->dirroot.'/templates/bootstrap.css';
$CFG->adddish_form = $CFG->dirroot.'/templates/adddish_form.php';
$CFG->diet = $CFG->dirroot.'/requests/dietgenerate.php';
$CFG->dishlist = $CFG->dirroot.'/requests/dishlist.php';
$CFG->dietjs = $CFG->dirroot.'/js/dietplanner.js';
$CFG->jquery = $CFG->dirroot.'/js/jquery-1.11.1.min.js';
$CFG->jqueryui = $CFG->dirroot.'/js/jquery-ui.min.js';
header('Content-Type: text/html; charset=utf-8');
?>


