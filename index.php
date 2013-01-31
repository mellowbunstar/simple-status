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
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="assets/css/master.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="assets/favicon.ico">
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
	  
		<?php require 'libs/process.php'; ?>
		
		<form action="index.php" method = "post" id="form-posts">
			<input type="text" name="body" id="body" class="input-block-level" placeholder="What would you like to say?" value="<?php echo (isset($body) ? $body : ''); ?>" />
			<div class="counter muted">140</div>
			<input type="submit" name="submit" class="btn btn-info" value="Share" />				
		</form>

		<?php	
			if (!$getPosts) {
				echo '<div class="alert alert-block">No posts found.</div>'."\r\n";
			}
			else {
				while($r = mysql_fetch_assoc($getPosts)) {

					echo '<div class="post" id="post-' . $r['statusId'] . '">
						<a href="index.php?delete=' . $r['statusId'] . '" class="close" title="Delete this post?">&times;</a>
						<h4>
							<i class="icon-github-alt icon-2x"></i>
							' . $r['username'] . '
						</h4>
						<p class="body">' . linkify($r['body']) . '</p>
						<p class="time muted">Posted ' . relative($r['date']) . ' ago.</p>
					</div>'."\r\n";
				}
		}
		?>
		
		<p class="footer muted"><a href="http://github.com/kirako/simple-status">&copy; <?php echo date("Y"); ?> Simple Status</a></p>
    </div>
    <script src="assets/js/jquery-1.9.0.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/master.js"></script>
  </body>
</html>
