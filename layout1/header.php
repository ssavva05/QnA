<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="./css1/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="./css1/style.css" rel="stylesheet" type="text/css">
        <link href="./css1/toggle.css" rel="stylesheet" type="text/css">
        <link href="./css1/custom.css" rel="stylesheet" type="text/css">
		<title><?php if(isset($title)){ echo $title; }?></title>
		<script src="./js/npm.js"></script>
		<script src="functionQuestion.js"></script>
</head>
<script>
            function rback() {
                window.location.href = <?php echo json_encode($back); ?>;
            }
</script>
<body>
	<div class="container">
		<div class="row">
		<nav class="navbar navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-inverse" style="color:white; font-size:150%; ">
                       <?php if(isset($textonnavbar)){ echo $textonnavbar; }?>&nbsp <button type="button" class="btn btn-lg btn-danger navbar-btn active v1 " onclick="rback();"><?php echo $textofback?></button> 
						
					</div>
				</div>
		
		</nav>