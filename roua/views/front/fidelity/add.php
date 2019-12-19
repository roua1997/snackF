	<?php
include dirname( __FILE__ ) . '/../baseFront.php';
checkLoggedIn();
if ( isset( $_POST["id"] ) ) {
	$id   = $_POST["id"];
	$fid  = $fidelityController->findFidelityById( $id );
	$user = Config::getUserSession();
	if ( $user && $fid ) {
		$request = new RequestFidelity();
		$request->setIdUser( Config::getUserSession()->getId() );
		$request->setUserName($user->getName() . ' ' . $user->getSurname() );
        $request->setIdFidelity( $id );
        $request->setFidelityName( $fid->getName() );
        $request->setStatus( 0 );
		$fidelityRequestController->addRequestFidelity($request);
	?>
        <script>
            window.location.replace("<?php echo curPageURL() . '/views/front/profile/fidelities.php' ?>");
        </script>
		<?php
    }

}
