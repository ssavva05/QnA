<?php
//DO NOT ECHO ANYTHING ON THIS PAGE OTHER THAN RESPONSE
//'true' triggers login success
ob_start();
include 'config.php';
require 'includes/functions.php';

// Define $myenroll_key and $mypassword
$enroll_key = $_POST['myenrollkey'];

// To protect MySQL injection
$enroll_key = stripslashes($enroll_key);


$response = '';
$loginCtl = new EnrollForm;
$conf = new GlobalConf;
$lastAttempt = checkAttempts($enroll_key);
$max_attempts = $conf->max_attempts;


//First Attempt
if ($lastAttempt['lastlogin'] == '') {

    $lastlogin = 'never';
    $loginCtl->insertAttempt($enroll_key);
    $response = $loginCtl->checkLogin($enroll_key);

} elseif ($lastAttempt['attempts'] >= $max_attempts) {

    //Exceeded max attempts
    $loginCtl->updateAttempts($enroll_key);
    $response = $loginCtl->checkLogin($enroll_key);

} else {

    $response = $loginCtl->checkLogin($enroll_key);

};

if ($lastAttempt['attempts'] < $max_attempts && $response != 'true') {

    $loginCtl->updateAttempts($enroll_key);
    $resp = new RespObj($enroll_key, $response);
    $jsonResp = json_encode($resp);
    echo $jsonResp;

} else {

    $resp = new RespObj($enroll_key, $response);
    $jsonResp = json_encode($resp);
    echo $jsonResp;

}

unset($resp, $jsonResp);
ob_end_flush();
