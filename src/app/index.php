<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/common/php/config.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/common/php/css.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/common/php/auth/auth.php');

	/*
	*  Try to authenticate using an authentication token
	*  provided via the GET parameter 'tok'. This is only used
	*  in the display page because standalone clients need to
	*  authenticate without user intervention. If the 'tok'
	*  parameter doesn't exist, fall back to the normal auth
	*  system ($wa_tok = NULL).
	*/
	$wa_tok = NULL;
	if (!empty($_GET['tok'])) {
		$wa_tok = $_GET['tok'];
	}
	web_auth(NULL, array("display"), TRUE, $wa_tok);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/app/css/display.css">
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/common/php/favicon.php'); ?>
		<title>Signage Display</title>
	</head>
	<body>
		<main role="main" class="container-fluid">
			<div id="display"></div>
			<div id="splash">
				<img
					src="/assets/images/logo/libresignage_text.svg"
					alt="LibreSignage logo.">
			</div>
		</main>
		<script src="/app/js/main.js"></script>
	</body>
</html>
