<?php

include_once '../racine.php';
include_once RACINE . "/service/FrameworkService.php";
include_once RACINE . "/classes/Framework.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadedImages = [];
    $uploadErrors = [];

    // Vérifiez si des images encodées sont présentes
    if (isset($_POST['image_paths']) && is_array($_POST['image_paths'])) {
        $imageDataArray = $_POST['image_paths'];

        foreach ($imageDataArray as $imageData) {
            // Générer un nom unique pour chaque image
            $imageName = uniqid() . '.png'; // You can change the extension if necessary
            $imageDestination = RACINE . '/images/' . $imageName;

            // Extraire les données de l'image base64
            if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                $imageData = substr($imageData, strpos($imageData, ',') + 1);
                $imageData = base64_decode($imageData);

                // Vérifiez si le décodage a réussi
                if ($imageData === false) {
                    $uploadErrors[] = "Failed to decode base64 image.";
                } else {
                    // Sauvegardez l'image sur le serveur
                    if (file_put_contents($imageDestination, $imageData)) {
                        $uploadedImages[] = $imageDestination;
                    } else {
                        $uploadErrors[] = "Failed to save the image: " . $imageName;
                    }
                }
            } else {
                $uploadErrors[] = "Invalid base64 image format.";
            }
        }

        // Continue si au moins une image a été téléchargée
        if (count($uploadedImages) > 0) {
            $name = $_POST['name'] ?? '';
            $descreption = $_POST['descreption'] ?? '';
            $domain = $_POST['domain'] ?? '';
            $dependencies = $_POST['dependencies'] ?? '';

            // Enregistrez les chemins des images comme une chaîne JSON dans le framework
            $imagesJson = json_encode($uploadedImages);
            $framework = new Framework(null, $name, $descreption, $domain, $dependencies, $imagesJson);
            $es = new FrameworkService();
            $result = $es->create($framework);

            if ($result) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Framework created successfully.',
                    'uploaded_images' => $uploadedImages,
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to create framework.',
                    'uploaded_images' => $uploadedImages,
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No images were successfully uploaded.',
                'upload_errors' => $uploadErrors,
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No images uploaded or upload error.',
        ]);
    }
}
