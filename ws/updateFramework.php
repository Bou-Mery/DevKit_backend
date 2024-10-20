<?php

include_once '../racine.php';
include_once RACINE . "/service/FrameworkService.php";
include_once RACINE . "/classes/Framework.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    updateFramework();
} else {
    echo json_encode(['message' => 'Méthode non autorisée.']);
}

function updateFramework() {

    if (isset($_POST['id'], 
                $_POST['name'], 
                $_POST['descreption'], 
                $_POST['domain'], 
                $_POST['dependencies'], 
                $_POST['image_path'])) {

        
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['descreption'];
        $domain = $_POST['domain'];
        $dependencies = $_POST['dependencies']; 
        $image_path = $_POST['image_path'];

        
        $frameworkService = new FrameworkService();
        
        
        $framework = new Framework(
            $id, 
            $name, 
            $description, 
            $domain, 
            $dependencies, 
            $image_path
        );

       
        if ($frameworkService->update($framework)) {
            echo json_encode(['message' => 'Updeted Seccessefully :) ']);
        } else {
            echo json_encode(['message' => 'Error']);
        }
    } else {
        echo json_encode(['message' => 'NO DATA !!!']);
    }
}
