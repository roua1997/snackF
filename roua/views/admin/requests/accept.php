<?php
include dirname( __FILE__ ) . '/../baseBack.php';
if ( isset( $_POST["id"] ) && isset( $_POST["idUser"] ) && isset( $_POST["idFidelity"] ) ) {
	$fid = $_POST["idFidelity"];
    $idu = $_POST["idUser"];
	$fidelity = $fidelityController->findFidelityById( $fid );
	$user = $userController->findUserById($idu);
	if ( $fidelity ) {
		$fidelityRequestController->acceptRequestFidelity( $_POST["id"], $_POST["idUser"], $fidelity->getId() );
		$message = 'You Request for the card '.$fidelity->getName(). ' has been accepted';
		UserController::sendEmail('Request Accepted',$message,$user->getEmail());
	}
	?>
    <script>
        window.location.replace("<?php echo curPageURL() . '/views/admin/requests' ?>");
    </script>
	<?php
	//header( 'Location: '.curPageURL().'/views/admin/users/' );
} else {
	echo 'error accepting';
}