<?php
include dirname(__FILE__) . '/../baseBack.php';

$users = $userController->getUsers();
$role = "All";
if (isset($_GET["role"])) {
    $role = $_GET["role"];
    if ($role == "user")
        $users = $userController->getUsersByRoles("user");
    else if ($role == "admin")
        $users = $userController->getUsersByRoles("admin");
    else
        $role = "All";
}
if (isset($_GET["searchName"])) {
    $searchName = $_GET["searchName"];
    $role = 'Filter Name : ' . $searchName;
    $users = $userController->searchUsersByName($searchName);
}
?>
<?php startblock('content') ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> User Management : <?php echo strtoupper($role) ?> </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active"><a href="#">Simple Tables</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-md-4">
            <a class="btn btn-info" href="./">All</a>
            <a class="btn btn-primary" href="./index.php?role=admin">Admins</a>
            <a class="btn btn-secondary" href="./index.php?role=user">Clients</a>
        </div>
        <div class="col-md-8">
            <form action="" method="get">
                <input name="searchName" style=" display:unset; width:200px" class="form-control" type="text" placeholder="Search by name">
                <input type="submit" class="btn btn-warning">
            </form>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">List of users</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users as $user) {
                                ?>
                                <tr>
                                    <td> <?php echo $user["id"] ?> </td>
                                    <td> <?php echo $user["username"] ?> </td>
                                    <td> <?php echo $user["name"] ?> </td>
                                    <td> <?php echo $user["surname"] ?> </td>
                                    <td> <?php echo $user["email"] ?> </td>
                                    <td> <?php echo $user["role"] ?> </td>
                                    <td>
                                        <form class="mr-2" style="float: left;" action="delete.php" method="post">
                                            <input type="hidden" value="<?PHP echo $user['id']; ?>" name="id">
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                        <form class="mr-2" style="float: left;" action="update.php" method="get">
                                            <input type="hidden" value="<?PHP echo $user['id']; ?>" name="id">
                                            <input type="submit" class="btn btn-info" value="Update">
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>


<?php endblock() ?>