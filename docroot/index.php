<?php 
	require_once('inc/init.inc');

	$title = 'Chapel';
	$javascript = 'window.onresize = verticalCenter;';
	$background_image = $base_url . '/img/back_vancouver.jpg';
	
	require_once('inc/header.inc');
	require_once('inc/nav.inc');
?>

		<div id="front">
				<img id="text" src="<?php echo($base_url); ?>/img/text-front.png" onload="verticalCenter();" alt="Chapel; inviting and uniting a generation to see God move in our city." />
				<img id="logo" src="<?php echo($base_url); ?>/img/logo.png" alt="Chapel" />
		</div>
		
	  <?php require_once('inc/social.inc'); ?>
<?php require_once('inc/footer.inc'); ?>
