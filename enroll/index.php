<?php require "queries.php";?>
<?php 
			$arr=array();
			$arr1=array();
			while( $row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($arr, $row['qidd']); array_push($arr1, $row['seen']);
			}
			$j=1;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="./css/style.css" rel="stylesheet" type="text/css">
    <link href="./css/toggle.css" rel="stylesheet" type="text/css">
    <link href="./css/custom.css" rel="stylesheet" type="text/css">
	<script>
            function rback() {
                window.location.href = 'enroll/logout.php';
            }
    </script>
  </head>
  <body>
    <div class="container">
		<nav class="navbar navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-inverse" style="color:white; font-size:150%; ">
                       <button type="button" class="btn btn-lg btn-danger navbar-btn active v1 " onclick="rback();">Exit to enrollment</button> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <h4>You have successfully enroll!</h4> 
						
					</div>
				</div>
		
		</nav>
                <br >
                <br >
		<div class="row">
		<h1>Welcome to &nbsp Course: <?php echo $result['cname']; ?></h1> <h2>&nbsp &nbsp &nbsp Lecture: <?php echo$result['lname'];?></h2></br>
		<ul>
			<?php foreach($arr as $i){?>
			<li><p style="font-size:130%;"> question <?php echo $j; $j++; ?>  <button  class="btn-success btn-lg btn  active v1" onclick="check(<?php echo $i?>,<?php echo $j;?>,<?php echo json_encode($arr1);?>)">GO</button></p></li>
			<?php } ?>
			</br>
		</div>
      </div>
    </div>
  </body>
</html>
<script>
function check(i,j,arr1){
	var k=j-2;
	if(!arr1[k]){
		alert("Question is not Active!");
	}else{
		k=k+1;
		window.location.href='question.php?var='+i+'&var1='+k;
	}
};		
</script>
