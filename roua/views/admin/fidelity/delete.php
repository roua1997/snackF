<?php
include dirname(__FILE__) . '/../baseBack.php';
if (isset($_POST["id"])) {
	$fidelityController->deleteFidelity($_POST["id"]);
	?>
	<script>
		window.location.replace("<?php echo curPageURL() . '/views/admin/fidelity' ?>");
	</script>
<?php
	//header( 'Location: '.curPageURL().'/views/admin/users/' );
}
