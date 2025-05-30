<?php

function DBConnect()
{
    $mysqli = new mysqli('localhost', 'root', '', 'htts');
    if ($mysqli->connect_errno != 0) {
        die("Error connecting database" . $mysqli->connect_error);
    }
    return $mysqli;
}

function getCountries()
{
    echo "vao ham get connry";
    $mysqli = DBConnect();
    if (!$mysqli) {
        return false;
    }
    $res = $mysqli->query("SELECT * FROM truong");
    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

if (isset($_GET["MaTruong"])) {
    echo getCities($_GET["MaTruong"]);
}

function getCities($MaTruong)
{
    $mysqli = DBConnect();
    if (!$mysqli) {
        return false;
    }
    $res = $mysqli->query("SELECT * from nganhhoc where MaTruong = '$MaTruong'");
    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
    return json_encode($data);
}