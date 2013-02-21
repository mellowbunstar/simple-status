<?php

if (isset($_GET['q'])) {
	if (strpos($_GET['q'], '#') === 0) {
		$hash = " WHERE `body` LIKE '%" . str_replace('%23','#',$_GET['q']) . "%'";
		$searched = str_replace('%23','#',$_GET['q']);
	}
}
	
if (isset($searched)) {
	echo '<div class="alert alert-info">
		Currently displaying posts for <strong>' . $searched . '</strong> <a href="index.php"><small>(reset)</small></a>
	</div>'."\r\n";
}
 
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
	if ($mysql->query("DELETE FROM `statuses` WHERE `statusId` = '" .$_GET['delete']."' LIMIT 1")) alert('Post successfully deleted.','success');
	else alert('Post was not deleted from the database.', 'error');
}