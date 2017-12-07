<?php
session_start();

//if (!isset($_SESSION['username'])) {
//    return header("location:../index.php");
//}


$temptab = filter_input_array(INPUT_POST);
if (empty($temptab)) {
    return header("location:../index.php");
} else {



//setting header to json
    //header('Content-Type: application/json');
    //$tbl_quest = "question";
    //$tbl_ans = "answer";
//print_r($temptab);

    foreach ($temptab as $key => $value) {
        $lid = $value;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Chart</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="./css/style.css" rel="stylesheet" type="text/css">
        <link href="./css/toggle.css" rel="stylesheet" type="text/css">
        <link href="./css/custom.css" rel="stylesheet" type="text/css">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script>
            function rback() {
                window.location.href = 'result.php';
            }
        </script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/Chart.min.js"></script>
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <!--<a class="navbar-brand" href="#"></a>-->

                        <button type="button" class="btn btn-lg btn-danger navbar-btn  active v1" onclick="rback();"> Back </button>
                       

                    </div>
                </div>
            </nav> 
            <br />
            <div class="row">
                <div class="col-md-3 col-md-offset-4">

                    <img src="img/ls.png" alt="Lecture Result Statistics" width="100%">
                </div>
            </div>


            <div id="chart-container">
                <canvas id="mycanvas"></canvas>
            </div>


            <script>


                function getRandomColor() {
                    var letters = '0123456789ABCDEF';
                    var color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }

                $(document).ready(function () {
                    $.ajax({
                        url: "http://localhost/QnA/res/lecdata.php",
                        method: "POST",
<?= "data : {" . $lid . " : " . $lid . "}," ?>

                        success: function (data) {
                            //console.log(data);
                            var player = [];
                            var score = [];
                            var color = [];


                            for (var i in data) {
                                player.push("Q:  " + data[i].textofquestion);
                                score.push(data[i].counter);
                                color.push(getRandomColor());
                            }

                            var chartdata = {
                                labels: player,
                                datasets: [
                                    {
                                        label: 'Number of Correct Answers',
                                        backgroundColor: color,
                                        borderColor: 'rgba(200, 200, 200, 0.75)',
                                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                                        data: score
                                    }
                                ]
                            };

                            var ctx = $("#mycanvas");

                            var barGraph = new Chart(ctx, {
                                type: 'horizontalBar',
                                data: chartdata,
                                options: {
                                    responsive: true,
                                    scales: {
                                        yAxes: [{
                                                ticks: {
                                                    beginAtZero: false
                                                }
                                            }],
                                        xAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }]
                                    }
                                }
                            });
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                });


            </script>



        </div>

        <footer><!-- FOOTER -->
            <div class="container">
                <p> &emsp; &emsp; </p>
                <p class="pull-right"><a href="#">Back to Top</a></p>
                <?php
                echo "&copy ";
                echo date("Y");
                echo "  QnA";
                ?>
            </div>
        </footer>
    </body>
</html>