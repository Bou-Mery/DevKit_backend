<?php

include_once '../racine.php';
include_once RACINE . "/service/FrameworkService.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    loadAllFrameworks();
}

function loadAllFrameworks() {
    $es = new FrameworkService();
    header('Content-Type: application/json');
    echo json_encode($es->findAll());
}

