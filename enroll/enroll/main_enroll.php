<?php
session_start();
if (isset($_SESSION['enroll_key'])) {
    header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Lecture QnA</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../css/main.css" rel="stylesheet" media="screen">
    </head>

    <body>
        <form class="form-signin" name="form1" method="post" action="checkenroll.php">
            <img src="images/logo_en.png" alt="Univercity of Cyprus Logo" width="99%">
            <img src="images/header.png" alt="Please Enroll to Lecture" width="100%">
            <!--<h2 class="form-signin-heading">Please Enroll to Lecture</h2>-->
            <input name="myenrollkey" id="myenrollkey" type="password" class="form-control" placeholder="Enrollment key" autofocus>
            <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Enroll</button>
            <div id="message"></div>
        </form>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-2.2.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- The AJAX login script -->
    <script src="js/enroll.js"></script>

</body>
</html>
