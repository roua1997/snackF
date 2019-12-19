<?php
include dirname( __FILE__ ) . '/../baseBack.php';
$requests = $fidelityRequestController->getRequests();
?>
<?php startblock( 'content' ) ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> Request List</h1>
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
                <h3 class="tile-title">List of requests</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Fidelity</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php
						foreach ( $requests

						as $request ) {
						?>
                        <tr
							<?php
							if ( $request["status"] == 1 ) {
								echo 'style="background: #cbffcb"';
							} else if ( $request["status"] == - 1 ) {
								echo 'style="background: #ffc8c8"';
							}
							?>
                        >
                            <td>
                                <a style="color: black"
                                   href="../users/update.php?id=<?php echo $request["id_user"] ?>">
                                    <strong><?php echo $request["user_name"] ?></strong>
                                </a>
                            </td>
                            <td> <?php echo $request["fidelity_name"] ?> </td>
                            <td>
								<?php
								if ( $request["status"] == 1 ) {
									echo 'Accepted';
								}
								else if ( $request["status"] == - 1 ) {
									echo 'Refused';
								} else {
									echo 'Pending';
								}
								?>
                            </td>
                            <td>
								<?php
								if ( $request["status"] == 0 ) {
									?>
                                    <form class="mr-2" style="float: left;" action="refuse.php" method="post">
                                        <input type="hidden" value="<?PHP echo $request['id']; ?>" name="id">
                                        <input type="submit" class="btn btn-danger" value="Refuse">
                                    </form>
                                    <form class="mr-2" style="float: left;" action="accept.php" method="post">
                                        <input type="hidden" value="<?PHP echo $request['id']; ?>" name="id">
                                        <input type="hidden" value="<?PHP echo $request['id_user']; ?>" name="idUser">
                                        <input type="hidden" value="<?PHP echo $request['id_fidelity']; ?>" name="idFidelity">
                                        <input type="submit" class="btn btn-info" value="Accept">
                                    </form>`
									<?php
								}
								?>
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
