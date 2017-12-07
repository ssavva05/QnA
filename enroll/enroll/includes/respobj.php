<?php
class RespObj
{
    public $enroll_key;
    public $response;
    public function __construct($enroll_key, $response)
    {

        $this->enroll_key = $enroll_key;
        $this->response = $response;

    }
}
