<?php require "queries.php";?>
<?php
		$counter=0;
		$j=0;
		if(isset($_POST['radio'])){
			foreach($_SESSION['arr'] as $i){
				if(strnatcmp($_POST['radio'],$i)==0){
					$counter=$_SESSION['arr1'][$j];
					$counter=$counter+1;
					$stmt = $db->prepare('UPDATE answer SET counter=:counter WHERE qidd = :qid AND textofanswer=:ta');
					$stmt->bindParam(':qid',$_SESSION['qid']);
					$stmt->bindParam(':ta',$i);
					$stmt->bindParam(':counter',$counter);
					$stmt->execute();
				}	
				$j++;
			}
				echo "<br /><br /><p style=\"font-size:150%\"class=\"alert-warning\">You have selected : ".$_POST['radio']."<br />"; 	
				if(strnatcmp($_POST['radio'],$_SESSION['answer'])==0){
					echo "<p style=\"font-size:150%\"class=\"alert-success\">And your answer is TRUE!!</p>";
				}else{
					echo "<p style=\"font-size:150%\" class=\"alert-danger\">And your answer is FALSE!!</p>";
				}
		}else{
			echo "<p style=\"font-size:150%\" class=\"alert-danger\">You didn't choose an answer!!</p>";
		}
		
?>