<?php require "includes/config.php";?>
<?php 
$lid=$_GET['var'];
$ltitle=$_GET['var1'];
$i=1;
$question=$_GET['question'];
$totalans=$_GET['totalans'];
$title = 'My Questions';
$back = 'lectures.php';
$textofback = 'Back';
//include header template
require('layout1/header.php'); 
?>

  
		<h1>My Questions</h1>
		<h2>Lecture: <?php echo $ltitle;?> </h2>
		<br>
		<br>
		<form action="" method=post>
		<h4><?php while($i<=$question){ ?>
			<input type="radio" id="radioQuestion" name="radioQuestion" value="<?php echo $i;?>">
			<label for = "radioQuestion">Question <?php echo $i?></label><br>
			<?php $i++;?>
		<?php } ?>
		<br></h4>
		<input class="btn btn-lg btn-primary navbar-btn active v1 " type="button" onclick="addQuestion(<?php echo $lid;?>,'<?php echo $ltitle;?>',<?php echo $question;?>,<?php echo $totalans;?>)" value="Add Question">
		<input class="btn btn-lg btn-success navbar-btn active v1 " type="submit" name="submit" value="Edit Question">
		<input class="btn btn-lg btn-danger navbar-btn active v1 " type="submit" name="delete" value="Delete Question">
		</form>
  </body>
</html>

<?php 
if(isset($_POST['submit'])){
			if(isset($_POST['radioQuestion'])){ ?>
			<script> editQuestion(<?php echo $lid;?>,'<?php echo $ltitle;?>',<?php echo $_POST['radioQuestion'];?>,<?php echo $totalans;?>);</script>
			<?php }else 
						echo "<script>alert(\"Attention: you have to select question first !\");</script>";
			
}
if(isset($_POST['delete'])){
	$question--;
	$stmt = $db->prepare('DELETE FROM question WHERE qid =:qid AND lid=:lid');
	$stmt->bindParam(':qid',$_POST['radioQuestion']);
	$stmt->bindParam(':lid',$lid);
	$stmt->execute();
	
	$stmt = $db->prepare('SELECT * FROM question WHERE lid=:lid;');
	$stmt->bindParam(':lid',$lid);
	$stmt->execute();
	$arr=array();
	
	while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
		array_push($arr,$result['qid']);
		
	}
	for($j=0; $j<$question; $j++){
		$jplus=$j+1;
		$stmt= $db->prepare('UPDATE question SET qid=:qid WHERE qid= :q AND lid= :lid;');
		$stmt->bindParam(':qid',$jplus);
		$stmt->bindParam(':q',$arr[$j]);
		$stmt->bindParam(':lid',$lid);
		$stmt->execute();
	}
	
	$stmt= $db->prepare('UPDATE lecture SET qcounter=:qc WHERE lid= :lid;');
	$stmt->bindParam(':lid',$lid);
	$stmt->bindParam(':qc',$question);
	$stmt->execute();
	
	?>
	<script>deleteQuestion(<?php echo $lid;?>,'<?php echo $ltitle;?>',<?php echo $question;?>,<?php echo $totalans;?>);</script>
	<?php echo "<script> alert('Question deleted'); </script>";

}
?>

