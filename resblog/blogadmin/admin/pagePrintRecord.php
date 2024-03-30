<?php
error_reporting(0);

$currDir = dirname(__FILE__);
include_once("{$currDir}/incCommon.php");
include_once("{$currDir}/incHeader.php");

$response = [];

$recID = filter_var(intval($_GET['recID']), FILTER_SANITIZE_NUMBER_INT);
if (empty($recID)) {
    $response[] = Notification::show(array(
        'message' => $Translation["record not found error"],
        'class' => 'danger',
        'dismiss_seconds' => 3600
    ));
    include("{$currDir}/incFooter.php");
    exit;
}

$res = sql("select * from membership_userrecords where recID='$recID'", $eo);
if (empty($row = db_fetch_assoc($res))) {
    $response[] = Notification::show(array(
        'message' => $Translation["record not found error"],
        'class' => 'danger',
        'dismiss_seconds' => 3600
    ));
    include("{$currDir}/incFooter.php");
    exit;
}

extract($row);

$tableName = htmlentities($tableName, ENT_QUOTES, 'UTF-8');
$pkValue = htmlentities($pkValue, ENT_QUOTES, 'UTF-8');
$memberID = strtolower($memberID);
$dateAdded = !empty($adminConfig['PHPDateTimeFormat']) ? date($adminConfig['PHPDateTimeFormat'], $dateAdded) : '';
$dateUpdated = !empty($adminConfig['PHPDateTimeFormat']) ? date($adminConfig['PHPDateTimeFormat'], $dateUpdated) : '';
$groupID = htmlentities($groupID, ENT_QUOTES, 'UTF-8');

$pkField = getPKFieldName($tableName);

$res = sql("select * from `{$tableName}` where `{$pkField}`='" . makeSafe($pkValue, false) . "'", $eo);
if (empty($row = db_fetch_assoc($res))) {
    $response[] = Notification::show(array(
        'message' => $Translation["record not found error"],
        'class' => 'danger',
        'dismiss_seconds' => 3600
    ));
    include("{$currDir}/incFooter.php");
    exit;
}

$thead = '<thead><tr><th>' . $Translation["field name"] . '</th><th>' . $Translation["value"] . '</th></tr></thead>';
$tbody = '';

foreach ($row as $fn => $fv) {
    $fv = htmlspecialchars($fv, ENT_QUOTES, 'UTF-8');
