<?php

include_once '../racine.php';
include_once RACINE . "/service/FrameworkService.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    loadFrameworkById($_POST['id']);
}else {
    echo json_encode(["message" => 'WALOOOO']);
}

function loadFrameworkById($id) {
    $es = new FrameworkService();
    header('Content-Type: application/json');
    $framework = $es->findById($id);

    if ($framework) {
        echo json_encode($framework);
    } else {
        echo json_encode(['message' => 'Framework non trouve']);
    }
}
