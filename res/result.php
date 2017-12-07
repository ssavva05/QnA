
<?php
//I WILL PUT THIS HEADER ON TOP OF EACH UNIQUE PAGE
session_start();

//if (!isset($_SESSION['username'])||!isset($_SESSION['lid'])) {
//    return header("location:../index.php");
//}
if (!isset($_SESSION['lid'])) {
    return header("location:../index.php");
}
///make the result making page
$tbl_quest = "question";
$tbl_ans = "answer";

$lectureID = $_SESSION['lid'];
//$lectureID = 1;

$db = new \stdClass();
$db->host = "localhost"; // Host name
$db->username = "root"; // Mysql username
$db->password = "root"; // Mysql password
$db->db_name = "qnadb"; // Database name
//$db->tbl_lecture = $tbl_lecture;


try {
    // Connect to server and select database.
    $db->conn = new PDO('mysql:host=' . $db->host . ';dbname=' . $db->db_name . ';charset=utf8', $db->username, $db->password);
    $db->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\Exception $e) {
    die('Database connection error');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Results</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="./css/style.css" rel="stylesheet" type="text/css">
        <link href="./css/toggle.css" rel="stylesheet" type="text/css">
        <link href="./css/custom.css" rel="stylesheet" type="text/css">
        <script>
            function apply() {
                document.forms["mycheckform2"].submit();
            }
            function rback() {
                window.location.href = '../lectures.php';
            }
        </script>
    </head>


    <body>
        <div class="container">
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <!--<a class="navbar-brand" href="#"></a>-->

                        <button type="button" class="btn btn-lg btn-danger navbar-btn  active v1" onclick="rback();"> Back </button>
                        <div class="divider"></div>
                        <button type="button" onclick="apply();" class="btn btn-lg btn-info navbar-btn active " > Lecture Statistics </button>

                    </div>
                </div>
            </nav> 
            <br />
            <div class="row">
                <div class="col-md-3 col-md-offset-4">
                    <!-- <h1>Results</h1>-->
                    <img src="img/res.png" alt="Results" width="100%">
                </div>
            </div>






            <?php
// SELECT qidd,textofquestion,seen,textofanswer FROM `question` WHERE lid=1 
//Find specific results for each question    
            $stmt = $db->conn->prepare("SELECT qidd,textofquestion,seen,textofanswer  FROM " . $tbl_quest . " WHERE lid = :lectureID");
            $stmt->bindParam(':lectureID', $lectureID);
            $stmt->execute();

// Gets query result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $i = 0;
            ?>


            <?php
            while ($result != NULL && $result != "" && $result != " " && (isset($result))) {
                $tqidd;
                $temp = new ArrayObject();
                foreach ($result as $key => $value) {
                    $i++;
                    //echo "Key: $key; Value: $value\n";
                    // echo($key . "=" . $value . "<br />");
                    $temp[$key] = $value;

                    if ($i == 1) {
                        $tqidd = $value;
                    }

                    if ($i == 4) {
                        //echo("<br />");
                        ?>
                        <form id="checkform" action="chart.php"  method="post">
                            <hr >
                            <div class ="row" >
                                <div class="col-md-3 col-md-offset-3">
                                    <h4 class="text-justify">
                                        <?= $temp['textofquestion'] ?>
                                    </h4>

                                </div>

                                <div class="col-md-3">
                                    <input type="hidden" name=<?= $tqidd ?> value=<?= $tqidd ?>>
                                    <input class="btn btn-success active btn-lg" type="submit" value="Results">
                                </div>

                            </div>
                        </form> 
                        <?php
                        $i = 0;
                    }
                }
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            ?>


            <hr />


            <div class="col-xs-1 col-xs-offset-2 "><div class= "v1">
                    <form id="mycheckform2" action="lecchart.php"  method="post">
                        <div class ="row" >
                            <input type="hidden" name=<?= $lectureID ?> value=<?= $lectureID ?>>
                           <!-- <input type="submit" class="btn btn-info active btn-lg" value="Overall Lecture Statistics">-->
                        </div>
                    </form>
                    <br />

                </div>
            </div>

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