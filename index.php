<?php
	date_default_timezone_set('America/New_York'); // Find your timezone -> http://us.php.net/manual/en/timezones.php
	require 'libs/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Simple Status</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="web/css/bootstrap.min.css" rel="stylesheet">
	<link href="web/css/font-awesome.min.css" rel="stylesheet">
	<link href="web/css/master.css" rel="stylesheet">
    <link href="web/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="web/favicon.ico">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container-narrow">

		<div class="masthead">
			<h3 class="muted"><i class="icon-star"></i> Simple Status</h3>
		</div>
		
		<?php include 'libs/actions.php'; ?>
	  
		<div id="form-posts">
			<?php require 'libs/process.php'; ?>
			<form action="index.php" method = "post">
				<input type="text" name="body" id="body" class="input-block-level" placeholder="What would you like to say?" value="<?php echo (isset($body) ? $body : ''); ?>">
				<div class="counter muted">140</div>
				<div class="spin"></div>
				<input type="submit" name="submit" class="btn btn-info" value="Share">				
			</form>
		</div>

		<div id="posts">
			<?php
				$getPosts = $mysql->query("SELECT * FROM `statuses` LEFT JOIN `users` ON statuses.userId = users.userId" . (isset($hash) ? $hash : '') ." ORDER BY `date` DESC");
				
				if (!$getPosts) {
					echo '<div class="alert alert-block">No posts found.</div>'."\r\n";
				}
				else {
					while($r = mysql_fetch_assoc($getPosts)) {
						post($r['statusId'], $r['username'], $r['body'], $r['date']);
					}
				}
			?>
		</div>
		
		<p class="footer muted"><a href="http://github.com/kirako/simple-status">&copy; <?php echo date("Y"); ?> Simple Status</a></p>
    </div>
    <script src="web/js/jquery-1.9.0.min.js"></script>
	<script src="web/js/bootstrap.min.js"></script>
	<script src="web/js/plugins.js"></script>
	<script src="web/js/master.js"></script>
  </body>
</html>
