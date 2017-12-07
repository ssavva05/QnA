<?php
 require('includes/config.php'); 

 
$title = 'Course Additon';
$back = 'memberpage.php';
$textofback = 'Back';
//include header template
require('layout1/header.php'); 
//include header template


?>
<br >
<form method="post">
<fieldset>
<legend>Please Complete the Details</legend>

     <div class ="form-group">
      <label for="name" class="control-label col-xs-2">Course name</label>
      <div class="col-xs-6">
      <input type="text" name="Coursename" id="Coursename" size="20" class="form-control" autofocus required pattern = "[A-Z]+[1-9]+" title="Please enter a name of the course(for example:EPL425)">
	   <hr>
	   <?php
			if(isset($_REQUEST["submit"])){
				$j=true;
				$cname=$_POST['Coursename'];
				$value=$_POST['selected'];
				$memberID=$_SESSION['memberID'];
				$Year=date("Y");
				$stmt = $db->prepare('SELECT dateof FROM Course WHERE cname = :cname');
				$stmt->bindParam(':cname',$cname);
				$stmt->execute();
				 $arr=array();
				 while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
					 array_push($arr,$result['dateof']);
				 }
				 if($value=="None"){
					 echo '<p class="alert-danger">'."You didn't enter the session".'</p>'; $j=false; }
				  				
				$value1=$Year."-09-01";
				$value2=$Year."-01-01"; 
				foreach ($arr as $i){ 
					if($value=="1"){
						if($i==$value1){
							echo '<p class="alert-danger">'."This course already exists on this session".'</p>'; $j=false; break;}}
				else if($value=="2"){
						if($i==$value2){
						echo '<p class="alert-danger">'."This course already exists on this session".'</p>'; $j=false; break;}}
					
				}
					
			  if($j){
				   $tempa=$Year."-9-1 00:00:00";
				  $tempb=$Year."-1-1 00:00:00";
				 if($value=="1"){
					 $stmt=$db->prepare('INSERT INTO Course(cname, memberID,dateof) VALUES (:cname,:memberID,:dateof)');
			 $stmt->execute(array(
					':cname' => $cname,
					':memberID' => $memberID,
					':dateof' =>$tempa
				));
			  }
				else{
					 $stmt=$db->prepare('INSERT INTO Course(cname, memberID,dateof) VALUES (:cname,:memberID,:dateof)');
			 $stmt->execute(array(
					':cname' => $cname,
					':memberID' => $memberID,
					':dateof'=> $tempb
				));
				 }
			echo "<script>
             alert('Course was created'); 
             window.location.href='memberpage.php';</script>";
			
		  }
		  }
		?>
	   <select method=post name="selected" >	
	   <option name="none" value="None">Please select the session</option>
		<option name="myselect2"  value="1">Χειμερινό Εξάμηνο</option>
		<option name="myselect3"   value="2">Εαρινό Εξάμηνο</option>				
		</select> 	 
	 </div></div>
<div class="buttonarea">
        <input class="btn btn-lg btn-success navbar-btn active v1 " type="submit" value="submit" name = "submit">
        <input class="btn btn-lg btn-warning navbar-btn active v1 " type="reset" value="Clear the Info">
</div>
</fieldset>
</form>
<?php require('layout1/footer.php'); ?>