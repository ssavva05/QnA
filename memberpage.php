<?php require('includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); exit(); }

//define page title
$title = 'My courses';
$back = 'logout.php';
$textofback = 'Log out';
//include header template
require('layout1/header.php'); 
?>
<?php //process addLecture form if submitted
?>
				<h2>Member only page - Welcome <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES); ?></h2>
				<hr>
				<h3>My Courses &nbsp &nbsp
				<?php $Year=date("Y/m/d"); echo $Year; ?> </h3>
				 <form action="" method="post">
				<?php				 
				  $memberID=$_SESSION['memberID'];
				  $stmt = $db->prepare('SELECT cname,dateof FROM Course WHERE memberID = :memberID');
			      $stmt->bindParam(':memberID',$_SESSION['memberID']);
			      $stmt->execute();				 
				 while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
					 
				 
				 ?>
				<h4><input type="radio" name="radio" value="<?php echo $result["cname"]." ".$result["dateof"];?>">
				 <?php echo $result["cname"]." "; 
				 $pieces = explode("-",
				 $result["dateof"]); 
				 if ($pieces[1]=="09") 
					 echo "Xειμερινό εξάμηνο ".$pieces[0];
				 else if ($pieces[1]=="01") 
				     echo "Eαρινό εξάμηνο ".$pieces[0]; ?></br>
				<?php
				}
				?></h4>
				<?php
				if(isset($_POST['editlectures']))
					if(!isset($_POST['radio']))
						echo '<p class="alert-danger">'."You have to select a lecture".'</p>';
				
			if(isset($_POST['editlectures'])){
				 if(isset($_POST['radio'])){
					$fullname=$_POST['radio'];
					$pieces = explode(" ",$fullname); 
					$cname=$pieces[0];
					$dateof=$pieces[1];		
					$_SESSION['cname']=$cname;
					$_SESSION['dateof']=$dateof;
					echo  "<script> window.location.href='lectures.php';</script>";

				  }
				}
				if(isset($_POST['addcourse'])){
					  echo  "<script> window.location.href='courseForm.php';</script>";
				  }
				
				if(isset($_POST['deletion']))
				 if(!isset($_POST['radio']))
						echo '<p class="alert-danger">'."You have to select a lecture".'</p>';
				 
				 
				if(isset($_POST['deletion'])){
				 if(isset($_POST['radio'])){
				  $fullname=$_POST['radio'];
				 $pieces = explode(" ",$fullname); 
				$cname=$pieces[0];
				 $dateof=$pieces[1];
				  $stmt = $db->prepare('Delete FROM Course WHERE memberID = :memberID AND cname=:cname AND dateof = :dateof');
				  $stmt->bindParam(':memberID',$memberID);
				  $stmt->bindParam(':cname',$cname);
				  $stmt->bindParam(':dateof',$dateof);
			      $stmt->execute();
			      echo  "<script> window.location.href='memberpage.php';</script>";
				 }
				}
				 
				 ?>
				<input class="btn btn-lg btn-primary navbar-btn active v1 " name="addcourse" type="submit" value="Add Course">
				<input class="btn btn-lg btn-danger navbar-btn active v1 " name="deletion" type="submit" value="Delete Course" >
			    <input class="btn btn-lg btn-success navbar-btn active v1 " name="editlectures" type="submit" value="Edit Lectures" >
				
				</form>

		</div>

	</div>


<?php 
//include header template
require('layout1/footer.php'); 
?>
