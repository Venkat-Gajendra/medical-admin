<?php

const DB_HOST = 'localhost:3307';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'edoc';

$database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (@$database->connect_error) {
    die('Connection failed: ' . @$database->connect_error);
}

?>
