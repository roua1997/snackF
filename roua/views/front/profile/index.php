<?php
include '../baseFront.php';
checkLoggedIn();
if ( Config::getUserSession() == null ) {
	?>
    <script>
        window.location.replace("<?php echo curPageURL() . '/views/front/login.php' ?>");
    </script>
	<?php

} else {
	$user     = $userController->findUserById( Config::getUserSession()->getId() );
	$fidelity = $fidelityController->findFidelityById( $user->getFidelity() );
	?>
	<?php startblock( 'content' ) ?>

    <main class="app-content">
    <div class="app-title">
     
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Profile</li>
        </ul>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="x_panel">
                <div class="x_content">
                    <br>
                    <form action="update.php" method="post" id="demo-form2" data-parsley-validate=""
                          class="form-horizontal form-label-left" novalidate="">
                        <input disabled type="hidden" name="id" value="<?php echo $user->getId() ?>">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">UserName <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input disabled type="text" id="name" name="username" required="required"
                                       value="<?php echo $user->getUsername() ?>"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input disabled type="text" id="name" name="name" required="required"
                                       value="<?php echo $user->getName() ?>" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Surname <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input disabled type="text" id="address" value="<?php echo $user->getSurname() ?>" name="surname"
                                       required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input disabled id="middle-name" value="<?php echo $user->getEmail() ?>"
                                       class="form-control col-md-7 col-xs-12" type="text" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Role</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                 <input disabled id="middle-name" value="<?php echo $user->getRole() ?>"
                                       class="form-control col-md-7 col-xs-12" type="text" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Number <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input disabled type="number" id="number" name="number" required="required"
                                       value="<?php echo $user->getNumber() ?>" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Card <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <?php if ( $fidelity == null ) {
                        echo 'No fidelity card';
                    } else {
                        echo $fidelity->getName() . ' ' . $fidelity->getValue() . '%';
                    }
                    ?>
                            </div>
                        </div>
                      
                    </form>
                </div>
            </div>
        </div>

    </div>
</main>

	<?php
	endblock();
}
?>