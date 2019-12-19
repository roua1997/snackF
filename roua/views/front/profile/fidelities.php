<?php
include dirname( __FILE__ ) . '/../baseFront.php';
checkLoggedIn();
$user     = Config::getUserSession();
$requests = $fidelityRequestController->getMyRequests( $user->getId() );
?>
<?php startblock( 'content' ) ?>
<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Requests</li>
        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">List of card requests
                        <a href="../fidelity/index.php" class="btn btn-sm btn-info">
                            Request a Card
                        </a>
                    </h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Fidelity</th>
                                <th>status</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php
							foreach (
								$requests

								as $request
							) {
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
    </div>
</main>


<?php endblock() ?>
