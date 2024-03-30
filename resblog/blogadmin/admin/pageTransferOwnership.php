<?php
require_once("{$currDir}/incCommon.php");
$page_title = $Translation['ownership batch transfer'];
include("{$currDir}/incHeader.php");

$sourceGroupID = intval(filter_var($_GET['sourceGroupID'], FILTER_SANITIZE_NUMBER_INT));
$sourceMemberID = filter_var(trim($_GET['sourceMemberID']), FILTER_SANITIZE_STRING);
$destinationGroupID = intval(filter_var($_GET['destinationGroupID'], FILTER_SANITIZE_NUMBER_INT));
$destinationMemberID = filter_var(trim($_GET['destinationMemberID']), FILTER_SANITIZE_STRING);
$moveMembers = intval(filter_var($_GET['moveMembers'], FILTER_SANITIZE_NUMBER_INT));

if ($sourceGroupID && $destinationGroupID && $sourceMemberID == -1) {
    $moveMembers = 0;
}

if ($sourceGroupID && $sourceMemberID && $destinationGroupID && ($destinationMemberID || $moveMembers)) {
    try {
        $db->beginTransaction();

        // Validate input
        if (!sqlValue("select count(1) from membership_users where memberID = ? and groupID = ?", [$sourceMemberID, $sourceGroupID])) {
            if ($sourceMemberID != -1) {
                errorMsg($Translation['invalid source member']);
                include("{$currDir}/incFooter.php");
            }
        }

        if (!$moveMembers) {
            if (!sqlValue("select count(1) from membership_users where memberID = ? and groupID = ?", [$destinationMemberID, $destinationGroupID])) {
                errorMsg($Translation['invalid destination member']);
                include("{$currDir}/incFooter.php");
            }
        }

        // Get group names
        $sourceGroup = $db->querySingle("select name from membership_groups where groupID = ?", [$sourceGroupID]);
        $destinationGroup = $db->querySingle("select name from membership_groups where groupID = ?", 
