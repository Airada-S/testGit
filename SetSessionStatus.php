<?php
session_start();
require_once './ConnectDatabase.php';

if(!isset($_SESSION['page'])){
    $_SESSION['page'] = 'null';
}
if($_SESSION['page'] == 'null'){
    $conn = new ConnectDB();
    $result = $conn->getAll();
}
if($_SESSION['page'] == 'searchByType'){
    $pt = $_REQUEST["pt"];
    $conn = new ConnectDB();
    $result = $conn->getByProductType($pt);
}if($_SESSION['page'] == 'searchBySellerName'){
    $search = $_REQUEST["search"];
    $conn = new ConnectDB();
    $result = $conn->getBySellerName($search);
}if($_SESSION['page'] == 'searchByProductName'){
    $search = $_REQUEST["search"];
    $conn = new ConnectDB();
    $result = $conn->getByProductName($search);
}
if(!isset($_SESSION['status'])){
    $_SESSION['status'] = 'null';
}
if($_SESSION['status'] == 'login'){
    echo $_SESSION['status'];
}

//session_destroy();




