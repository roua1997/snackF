<?php
include dirname( __FILE__ ) . '/baseFront.php';
$message = "";
if ( isset( $_POST['email'] ) ) {
	$mail    = $_POST['email'];
	$pass    = $_POST['password'];
	$message = "";
	if ( empty( $mail ) || empty( $pass ) ) {
		$message = "Username/Password can't be empty";
	} else {
        if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $mail)){
            $message = "invalid email" ;
        }else{
            $user = $userController->findUser( $mail, $pass );
            //var_dump( $user );
            if ( $user instanceof User ) {
                Config::setUserSession( $user );
                if ( $user->getRole() == "user" ) {
                    ?>
                    <script>
                        window.location.replace("<?php echo curPageURL() . '/views/front' ?>");
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        window.location.replace("<?php echo curPageURL() . '/views/admin' ?>");
                    </script>
                    <?php
                }
            } else {
                $message = "Wrong credentials";
            }

        }
		
	}
}
?>
<?php startblock( 'content' ) ?>
<div class="clearfix" style="width: 100%">
    <div class="row mt-100">
        <div class="col-md-6 offset-2">
            <form action="" method="post" class="form">
                <div class="row">
                    <span style="color: red"><?php echo $message ?></span>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Email</label>
                        <input name="email" type="text" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Password</label>
                        <input name="password" type="password" class="form-control">
                    </div>
                    <div>
                        <input type="submit" class="btn btn-success" value="Login">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endblock() ?>
