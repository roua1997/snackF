<?php
include dirname(__FILE__) . '/../baseFront.php';
checkLoggedIn();
$fidelities = $fidelityController->getFidelities();
$user       = $userController->findUserById(Config::getUserSession()->getId());
$myfidelity   = $fidelityController->findFidelityById($user->getFidelity());
?>
<?php startblock('content') ?>
<main class="app-conten container">
    <div class="app-title mt-15">
        <div>
            <h4><i class="fa fa-th-list"></i> List of Fidelity Cards</h4>
        </div>
    </div>
    <div class="row">
        <?php

        foreach ($fidelities as $fidelity) {

            $background = "#f9f9f9";
            if ($fidelity["value"] < 15) {
                $background = "#f9f9f9";
            } else if ($fidelity["value"] < 35) {
                $background = "#ffc297";
            } else {
                $background = "#ffc800";
            }

            ?>
            <div class="card col-md-4">
                <div class="card-header text-center" style="background : <?php echo $background ?>">
                    <?php echo $fidelity["name"] ?> Catd
                </div>
                <div class="card-body text-center">
                    <img style="height: 203px;width: 280px;object-fit: contain;" src="../assets/bg-card.jpg" alt="">
                    <p><strong><?php echo $fidelity["name"] ?></strong></p>
                    <p> <?php echo $fidelity["code"] ?></p>
                    <p> <?php echo $fidelity["value"] ?> % Discount</p>
                    <?php
                        if ($myfidelity == null) {
                            ?>
                        <td>
                            <form class="text-center" action="add.php" method="post">
                                <input type="hidden" value="<?PHP echo $fidelity['id']; ?>" name="id">
                                <input type="submit" class="btn btn-secondary" value="Request">
                            </form>
                        </td>
                    <?php
                        } else {
                            echo '<td></td>';
                        }
                        ?>
                </div>
            </div>

        <?php
        }
        ?>
    </div>
</main>


<?php endblock() ?>