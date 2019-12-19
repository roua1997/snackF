<?php
include dirname(__FILE__) . '/../baseBack.php';
$fidelities = $fidelityController->getFidelities();

?>
<?php startblock('content') ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> Fidelity Management</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active"><a href="#">Simple Tables</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">List of Fidelities</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($fidelities as $fidelity) {
                                ?>
                                <tr>
                                    <td> <?php echo $fidelity["id"] ?> </td>
                                    <td> <?php echo $fidelity["name"] ?> </td>
                                    <td> <?php echo $fidelity["code"] ?> </td>
                                    <td> <?php echo $fidelity["value"] ?> % </td>
                                    <td>
                                        <form class="mr-2" style="float: left;" action="delete.php" method="post">
                                            <input type="hidden" value="<?PHP echo $fidelity['id']; ?>" name="id">
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                        <form class="mr-2" style="float: left;" action="update.php" method="get">
                                            <input type="hidden" value="<?PHP echo $fidelity['id']; ?>" name="id">
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