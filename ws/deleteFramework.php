<?php

include_once '../racine.php';
include_once RACINE . "/service/FrameworkService.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    deleteFramework($_POST['id']);
}else{
   echo json_encode(['message' => 'WALOO']);
}

function deleteFramework($id) {
    $fs = new FrameworkService();
    
    if ($fs->delete($id)) {
        echo json_encode(['status' => '200']);
    } else {
        echo json_encode(['status' => '404']);
    }
}

