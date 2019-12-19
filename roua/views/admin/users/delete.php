<?php
include dirname( __FILE__ ) . '/../baseBack.php';
if (isset($_POST["id"])){
	$userController->deleteUser($_POST["id"]);
	?>
    <script>
        window.location.replace("<?php echo curPageURL().'/views/admin/users' ?>");
    </script>
	<?php
	//header( 'Location: '.curPageURL().'/views/admin/users/' );
}