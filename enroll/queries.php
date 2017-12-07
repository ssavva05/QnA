<?php require "includes/config.php";?>
<?php 
			$stmt = $db->prepare('SELECT * FROM lecture WHERE enroll_key = :enroll_key');
			$stmt->bindParam(':enroll_key',$_SESSION['enroll_key']);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if(!isset($result['cname'])){
				header ("Location:./enroll/main_enroll.php");
			}
		
			$stmt = $db->prepare('SELECT * FROM question WHERE lid=:lid');
			$stmt->bindParam(':lid',$result['lid']);
			$stmt->execute();
?>