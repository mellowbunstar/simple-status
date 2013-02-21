<?php
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	foreach ($_POST as $key => $val) $$key = clean($val);
	
	if (!isset($_POST['ajx'])) $ajx = false;
	
	if (empty($body)) {
		alert('Post cannot be empty.', 'error');
	}
	else {
		if (strlen($body) > 140) {
			alert('Post can only be 140 characters max.', 'error');
		}
		else {
			if(!$mysql->query("INSERT INTO `statuses` (`userId`, `date` ,`body`) VALUES (1, NOW(), '" . clean($body) . "')")) {
				alert('Post was not added.', 'error');
			}
			else {
				if ($ajx) {
					$id = mysql_insert_id();
					$name = $mysql->single("SELECT `username` FROM `statuses` LEFT JOIN `users` ON statuses.userId = users.userId WHERE `statusId` = " . $id); 
					post($id, $name, $body, TODAY);
				}
				else {
					alert('Post successfully added!', 'success');
				}
			}			
		}
	}
}