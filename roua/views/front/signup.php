<?php
include dirname(__FILE__) . '/baseFront.php';
$message = "";

if (isset($_POST['username'])) {

    if (empty($_POST["username"]) || !ctype_alpha($_POST["username"])) {
        $message = "invalid username";
    } else if (!isset($_POST["name"]) || !ctype_alpha($_POST["name"])) {
        $message = "invalid name";
    } else if (empty($_POST["surname"]) || !ctype_alpha($_POST["surname"])) {
        $message = "invalid surname";
    } else if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_POST["email"])) {
        $message = "invalid email";
    } else if (empty($_POST["password"])) {
        $message = "invalid password";
    } else if (empty($_POST["number"]) || !is_numeric($_POST["number"])) {
        $message = "invalid number";
    } else {
        $user = new User();
        $user->setUsername($_POST["username"]);
        $user->setName($_POST["name"]);
        $user->setSurname($_POST["surname"]);
        $user->setPassword($_POST["password"]);
        $user->setEmail($_POST["email"]);
        $user->setRole("user");
        $user->setNumber($_POST["number"]);

        $result = $userController->addUser($user);
        //var_dump($result);
        if ($result === true) {
            ?>
            <script>
                window.location.replace("<?php echo curPageURL() . '/views/front/login.php' ?>");
            </script>
<?php
        }
    }
}
?>

<?php startblock('content') ?>
<main class="app-content">
    <div class="app-title">

        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Singup</li>
        </ul>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Signup</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <p style="color:red"> <?php echo $message ?> </p>
                    <form action="" method="post" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">UserName <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" name="username" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Surname <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="address" name="surname" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="password" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Number <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="number" name="number" required="required" class="form-control col-md-7 col-xs-12">
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

<?php endblock() ?>