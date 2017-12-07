<?php require "queries.php";?>
<?php 
$qid=$_GET['var'];
$qnum=$_GET['var1'];
$_SESSION['qid']=$qid;

$stmt = $db->prepare('SELECT * FROM question WHERE qidd = :qid');
$stmt->bindParam(':qid',$qid);
$stmt->execute();
$result1 = $stmt->fetch(PDO::FETCH_ASSOC);
$_SESSION['answer']=$result1['textofanswer'];
$stmt = $db->prepare('SELECT * FROM answer WHERE qidd = :qid');
$stmt->bindParam(':qid',$qid);
$stmt->execute();
$arr=array();
$_SESSION['arr']=array();
$arr1=array();
$_SESSION['arr1']=array();
$flag=false;
while( $row=$stmt->fetch(PDO::FETCH_ASSOC)) {
   array_push($_SESSION['arr'], $row['textofanswer']); array_push($arr, $row['textofanswer']); array_push($_SESSION['arr1'], $row['counter']); array_push($arr1, $row['counter']);
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Question</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="./css/style.css" rel="stylesheet" type="text/css">
    <link href="./css/toggle.css" rel="stylesheet" type="text/css">
    <link href="./css/custom.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="LIB/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="jquery.countdownTimer.min.js"></script>
    <link rel="stylesheet" type="text/css" href="CSSc/jquery.countdownTimer.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script>
            function rback() {
                window.location.href = 'index.php';
            }
    </script>
  </head>
  <body>
	
    <div class="container">
		<div class="row">
		<nav class="navbar navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-inverse">
                        <button type="button" class="btn btn-lg btn-danger navbar-btn active v1 " onclick="rback();"> Back to Questions </button>
					</div>
				</div>
		
		</nav>
		<h2><strong>Welcome to	Question <?php echo $qnum; ?>!</strong></h2>
		<div id="countdowntimer"><span id="color_timer"></span></div>
		<h2>Question: <?=$result1['textofquestion']?></h2>  
		<h3>Please choose one of the following answers:</h3>
		<form id="myForm" class="form" method="post">
			<?php foreach($arr as $i){?>
				<b><span style="font-size:130%"><input type="radio" name="radio"  value=" <?php echo $i ?>"><?php echo $i ?></span></b><br>
			<?php } ?>
			<!--<input type="button" id="submitFormData"  value="Submit" />-->
		</form>
		<div id="results"> </div>
		</div>
    </div>
  </body>
</html>
 <script>
    $(function(){
		$(function(){
        $('#color_timer').countdowntimer({
            minutes:0,
			seconds:10,
            size : "lg",
			timeUp : timeisUp,
            borderColor : "#1F1A4F",
            backgroundColor : "#C82027",
             fontColor : "#FFFFFF"
        });
    });
		
	function timeisUp() {
		SubmitFormData();
    }
    });
</script>
<script>
	SubmitFormData=function() {
	var radio = $("input[type=radio]:checked").val();
	$.post("submit.php", { radio: radio },
	   function(data) {
		 $('#results').html(data);
	   });
	}
 </script>
 