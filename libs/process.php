<?php

if (isset($_GET['q'])) {
	if (strpos($_GET['q'], '#') === 0) {
		$hash = " AND `body` LIKE '%" . str_replace('%23','#',$_GET['q']) . "%'";
		$searched = str_replace('%23','#',$_GET['q']);
	}
}
	
if (isset($searched)) {
	echo '<div class="alert alert-info">
		Currently displaying posts for <strong>' . $searched . '</strong> <a href="index.php"><small>(reset)</small></a>
	</div>'."\r\n";
}
 
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
	if ($mysql->query("DELETE FROM `statuses` WHERE `statusId` = '" .$_GET['delete']."' LIMIT 1")) echo alert('Post successfully deleted.','success');
	else alert('Post was not deleted from the database.', 'error');
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
	$body = $_POST['body'];
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
				$body = '';
				alert('Post successfully added!', 'success');
			}			
		}
	}
}

$getPosts = $mysql->query("SELECT * FROM `statuses` LEFT JOIN `users` ON statuses.userId = users.userId" . (isset($hash) ? $hash : '') ." ORDER BY `date` DESC");