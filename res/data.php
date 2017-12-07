<?php

$temptab = filter_input_array(INPUT_POST);
if (empty($temptab)) {
    return header("location:../index.php");
} else {



//setting header to json
    header('Content-Type: application/json');


    $tbl_quest = "question";
    $tbl_ans = "answer";
//print_r($temptab);

    foreach ($temptab as $key => $value) {
        $qidd = $value;
    }


    //$stmt = $db->conn->prepare("SELECT textofanswer, counter FROM " . $tbl_ans . " WHERE qidd = :quesID ORDER BY qidd");
//database
    define('DB_HOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'qnadb');

//get connection
    $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if (!$mysqli) {
        die("Connection failed: " . $mysqli->error);
    }

//query to get data from the table
    $query = sprintf("SELECT textofanswer, counter FROM " . $tbl_ans . " WHERE qidd =" . $qidd);

//execute query
    $result = $mysqli->query($query);

//loop through the returned data
    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }

//free memory associated with result
    $result->close();

//close connection
    $mysqli->close();

    unset($_POST);
//now print the data
    //bridge
    print json_encode($data);
    //kaleis to consumer to js
}