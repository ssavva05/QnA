<?php
//I WILL PUT THIS HEADER ON TOP OF EACH UNIQUE PAGE
session_start();
if (!isset($_SESSION['enroll_key'])) {
    return header("location:enroll/main_enroll.php");
}
