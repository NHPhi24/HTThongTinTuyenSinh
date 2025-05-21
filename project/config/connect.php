<?php
    define('ROOT_URL' , 'http://localhost/HTThongtintuyensinh/project/');
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'htts';
    
    $conn = new mysqli($server,$username,$password,$db);
    
    if (!$conn) {
        echo 'Server is error';
    }
?>