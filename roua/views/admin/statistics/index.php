<?php
include dirname(__FILE__) . '/../baseBack.php';
$fidelities = $fidelityController->getFidelities();
$users = $userController->getUsers();

$results = [];
$data = [];

$countClient = 0;
$countAdmin = 0;
foreach ($users as $user) {
    if ($user["role"] == "admin") {
        $countAdmin++;
    } else {
        $countClient++;
    }
}

foreach ($fidelities as $fidelity) {
    $results[] = $fidelity;
    $requests = $fidelityRequestController->getRequestByIdFidelity($fidelity['id']);
    $count = 0;
    foreach ($requests as $request) {
        $count++;
    }
    $array = array(
        "count" => $count,
        "name" => $fidelity['name'],
    );
    $data[] = $array;
}


?>
<?php startblock('content') ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> Statistics</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"> Statistics</li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Request Fidelity</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Users</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="doughnutChartDemo"></canvas>
                </div>
            </div>
        </div>
    </div>
</main>


<?php endblock() ?>.


<?php startblock('scripts') ?>

<!-- Page specific javascripts-->
<script type="text/javascript" src="js/plugins/chart.js"></script>
<script type="text/javascript">
    var data = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [{
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 86]
            }
        ]
    };
    var fidelities = <?php echo json_encode($results) ?>;
    var requests = <?php echo json_encode($data) ?>;

    const colors = ["#F7464A", "#46BFBD", "#FDB45C"];
    const highlights = ["#FF5A5E", "#5AD3D1", "#FFC870"];
    var pdata = [];
    var userData = [{
        value: <?php echo $countAdmin ?>,
        color: colors[1],
        highlight: highlights[1],
        label: 'Admins'
    }, {
        value: <?php echo $countClient ?>,
        color: colors[2],
        highlight: highlights[2],
        label: 'Clients'
    }];
    requests.forEach((element, index) => {
        const item = {
            value: element.count,
            color: colors[index],
            highlight: highlights[index],
            label: element.name
        };
        pdata.push(item);
    });
    console.log({
        pdata
    });
    /*
        var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data);

        var ctxb = $("#barChartDemo").get(0).getContext("2d");
        var barChart = new Chart(ctxb).Bar(data);

        var ctxr = $("#radarChartDemo").get(0).getContext("2d");
        var radarChart = new Chart(ctxr).Radar(data);

        var ctxpo = $("#polarChartDemo").get(0).getContext("2d");
        var polarChart = new Chart(ctxpo).PolarArea(pdata);
    */
    var ctxp = $("#pieChartDemo").get(0).getContext("2d");
    var pieChart = new Chart(ctxp).Pie(pdata);

    var ctxd = $("#doughnutChartDemo").get(0).getContext("2d");
    var doughnutChart = new Chart(ctxd).Doughnut(userData);
</script>


<?php endblock() ?>