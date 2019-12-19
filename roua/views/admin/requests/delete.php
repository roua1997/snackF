<?php
include dirname( __FILE__ ) . '/../baseBack.php';
if (isset($_POST["id"])){
	$fidelityRequestController->deleteRequestFidelity($_POST["id"]);
	?>
    <script>
        window.location.replace("<?php echo curPageURL().'/views/admin/requests' ?>");
    </script>
	<?php
	//header( 'Location: '.curPageURL().'/views/admin/users/' );
}