
<?php require('includes/config.php'); 
//define page title
$title = 'My Lectures';
$back = 'memberpage.php';
$textofback = 'Back';
//include header template
require('layout1/header.php');
 
?>
<?php //process addLecture form if submitted
?>

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-7 col-sm-offset-2 col-md-offset-3">
				<h2>My Lectures-<?php $cname=$_SESSION['cname']; $dateof=$_SESSION['dateof']; echo $cname." ";
				$pieces = explode("-",$dateof); 
					if ($pieces[1]=="09") 
					 echo "Xειμερινό εξάμηνο ".$pieces[0];
				 else if ($pieces[1]=="01") 
				     echo "Eαρινό εξάμηνο ".$pieces[0]; ?></h2>
			<form action="" method="post">
				<?php				
				  $cname=$_SESSION['cname'];
				  $stmt = $db->prepare('SELECT * FROM Lecture WHERE cname = :cname AND dateof =:dateof');
			      $stmt->bindParam(':cname',$cname);
				  $stmt->bindParam(':dateof',$dateof);
			      $stmt->execute();
				 while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
				 ?>
				<h4><input type="radio" name="radio" value="<?php echo $result["lid"];?>">
				<?php echo "Lecture: ".$result["lname"]; ?>
				</br>
				<?php
				}
				?></h4>
				<?php
				if(isset($_POST['editquestions']))
					if(!isset($_POST['radio']))
						echo '<p class="alert-danger">'."You have to select a lecture".'</p>';
				
			if(isset($_POST['editquestions'])){
				 if(isset($_POST['radio'])){
					  $_SESSION['lid']=$_POST['radio']; 
                                           $stmt = $db->prepare('SELECT lname FROM Lecture WHERE lid = :lid');
                                          $stmt->bindParam(':lid', $_SESSION['lid']);
                                             $stmt->execute();
                                          $result=$stmt->fetch(PDO::FETCH_ASSOC);
                                        $var1=$result['lname'];
                                          $stmt = $db->prepare('SELECT qcounter FROM Lecture WHERE lid = :lid');
                                          $stmt->bindParam(':lid', $_SESSION['lid']);
                                             $stmt->execute();
                                          $result=$stmt->fetch(PDO::FETCH_ASSOC);
                                        $questions=$result['qcounter'];
                                            header("Location:myQuestions.php?var=".$_SESSION['lid']."&var1=".$var1."&question=".$questions."&totalans=0");
                                       
                              
                               
                                 }
				}
				if(isset($_POST['startlecture']))
					if(!isset($_POST['radio']))
						echo '<p class="alert-danger">'."You have to select a lecture".'</p>';
				
			if(isset($_POST['startlecture'])){
				 if(isset($_POST['radio'])){
					  $_SESSION['lid']=$_POST['radio'];
					  echo  "<script> window.location.href='res/index.php';</script>";

				  }
				}
				if(isset($_POST['addlecture'])){
					  $_SESSION['cname']=$cname;
					  $_SESSION['dateof']=$dateof;
					  echo  "<script> window.location.href='LectureForm.php';</script>";
				}
                                
				if(isset($_POST['deletion']))
					if(!isset($_POST['radio']))
						echo '<p class="alert-danger">'."You have to select a lecture".'</p>';
				 
				 
		    if(isset($_POST['deletion'])){
				 if(isset($_POST['radio'])){
				  $lid=$_POST['radio'];
				  $stmt = $db->prepare('DELETE FROM Lecture WHERE lid = :lid');
			      $stmt->bindParam(':lid',$lid);
			      $stmt->execute();
				  echo  "<script> window.location.href='lectures.php';</script>";
				 }
				}
                                if(isset($_POST['lectureresults']))
					if(!isset($_POST['radio']))
						echo '<p class="alert-danger">'."You have to select a lecture".'</p>';
				 
				 
		    if(isset($_POST['lectureresults'])){
				 if(isset($_POST['radio'])){
				  $lid=$_POST['radio'];
                                  $_SESSION['lid']=$lid;
				  echo  "<script> window.location.href='res/result.php';</script>";
				 }
				}
				
				?>
				<input class="btn btn-lg btn-primary navbar-btn active v1 " name="addlecture" type="submit" value="Add Lecture">
				<input class="btn btn-lg btn-danger  navbar-btn active v1 " name="deletion" type="submit" value="Delete Lecture" >
				<input class="btn btn-lg btn-success navbar-btn active v1 " name="editquestions" type="submit" value="Edit Questions">
			    <input class="btn btn-lg btn-warning navbar-btn active v1 " name="startlecture" type="submit" value="Start Lecture">
                <input class="btn btn-lg btn-success navbar-btn active v1 " name="lectureresults" type="submit" value="Lecture Results">
			    
				
		</form>
	</div>
</div>

<?php 
//include header template
require('layout1/footer.php'); 
?>
