<?php 
	require_once('inc/init.inc');

	$title = 'Chapel';
	$javascript = 'window.onresize = verticalCenter;';
	$background_image = '/img/back_vancouver.jpg';
	
	require_once('inc/header.inc');
	require_once('inc/nav.inc');
?>

		<div id="front">
				<img id="text" src="/img/text-front.svg" onload="verticalCenter();" alt="Chapel; inviting and uniting a generation to see God move in our city." />
				<img id="logo" src="/img/logo.svg" alt="Chapel" />
		</div>
		
	  <?php require_once('inc/social.inc'); ?>
<?php require_once('inc/footer.inc'); ?>
