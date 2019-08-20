<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/common/php/config.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/common/php/css.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/common/php/auth/auth.php');
	web_auth(NULL, NULL, TRUE);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/control/css/control.css">
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/common/php/favicon.php'); ?>
		<title>Signage Control Panel</title>
	</head>
	<body>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].NAV_PATH); ?>
		<main class="container-fluid">
			<div class="row container-fluid mx-auto">
				<div class="col-md-12 header-col">
					<h1>Welcome!</h1>
				</div>
			</div>
			<div class="row ctrl-panel-row container-fluid">
				<div class="col-md-6 ctrl-panel-col">
					<h4>Your quota</h4>
					<div id="user-quota-cont">
					</div>
				</div>
				<div class="col-md-6 ctrl-panel-col cont-info-primary">
					<h4>Problems using LibreSignage?</h4>
					<p>This LibreSignage instance is
					maintained by <?php echo ADMIN_NAME; ?>.
					If you have any problems using
					LibreSignage, please email the admin at
					<a href="mailto: <?php echo ADMIN_EMAIL; ?>">
					<?php echo ADMIN_EMAIL; ?></a>.</p>
				</div>
			</div>
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].FOOTER_PATH); ?>
		<script src="/control/js/main.js"></script>
	</body>
</html>
