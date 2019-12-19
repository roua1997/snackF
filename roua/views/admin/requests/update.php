<?php
include dirname( __FILE__ ) . '/../baseBack.php';
$user  = new User();
$roles = array( "admin", "user" );
if ( isset( $_GET['id'] ) ) {
	$user = $userController->findUserById( $_GET['id'] );
}
if ( isset( $_POST['id'] ) ) {
	$user = new User();
	$user->setId( $_POST["id"] );
	$user->setUsername( $_POST["username"] );
	$user->setName( $_POST["name"] );
	$user->setSurname( $_POST["surname"] );
	$user->setEmail( $_POST["email"] );
	$user->setRole( $_POST["role"] );
	$user->setNumber( $_POST["number"] );
	$result = $userController->updateUser( $user );
	//var_dump($result);
	if ( $result === true ) {
		?>
        <script>
            window.location.replace("<?php echo curPageURL() . '/views/admin/users' ?>");
        </script>
		<?php
	}
}
?>

<?php startblock( "content" ); ?>
<!-- top tiles -->
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> User Management</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active"><a href="#">Simple Tables</a></li>
        </ul>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Update User
                        <small>
	                        <?php echo $user->getUsername() ?>
                        </small>
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form action="update.php" method="post" id="demo-form2" data-parsley-validate=""
                          class="form-horizontal form-label-left" novalidate="">
                        <input type="hidden" name="id" value="<?php echo $user->getId() ?>">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">UserName <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" name="username" required="required"
                                       value="<?php echo $user->getUsername() ?>"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" name="name" required="required"
                                       value="<?php echo $user->getName() ?>" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Surname <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="address" value="<?php echo $user->getSurname() ?>" name="surname"
                                       required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle-name" value="<?php echo $user->getEmail() ?>"
                                       class="form-control col-md-7 col-xs-12" type="text" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Role</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="role" class="form-control">
                                    <option value="" selected disabled hidden>Choose here</option>
									<?php

									foreach ( $roles as $role ) {
										if ( $role == $user->getRole() ) {
											echo '<option selected="selected" value="' . $role . '">' . $role . '</option>';
										} else {
											echo '<option value="' . $role . '">' . $role . '</option>';
										}
									}
									?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Number <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="number" name="number" required="required"
                                       value="<?php echo $user->getNumber() ?>" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-info" value="Modifier">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</main>


<?php endblock(); ?>

