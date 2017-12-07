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
        $lid = $value;
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
    $query = sprintf("SELECT qidd,textofanswer FROM " . $tbl_quest . " WHERE lid =" . $lid);
//execute query
    $result = $mysqli->query($query);
    $data2 = array();

    $i = 0;

    foreach ($result as $key => $value) {


        $query2 = sprintf("SELECT counter,qidd FROM `" . $tbl_ans . "` WHERE qidd = " . $value['qidd'] . " AND textofanswer = '" . $value['textofanswer'] . "'");
//execute query
        $result2 = $mysqli->query($query2);

        $temp = 0;

        foreach ($result2 as $key2 => $value2) {
            $query3 = sprintf("SELECT textofquestion FROM `" . $tbl_quest . "` WHERE qidd = " . $value['qidd']);
            $result3 = $mysqli->query($query3);
            foreach ($result3 as $key3 => $value3) {
                $value2['qidd'] = $value3['textofquestion'];
            }
            $data2[] = $value2;
        }

        $result2->close();
    }


    $data2 = array_map(function($tag) {
        return array(
            'counter' => $tag['counter'],
            'textofquestion' => $tag['qidd']
        );
    }, $data2);

    //print_r($data2);
//free memory associated with result
    $result->close();

//close connection
    $mysqli->close();

    unset($_POST);
//now print the data
    //bridge
    print json_encode($data2);
    //kaleis to consumer to js
}