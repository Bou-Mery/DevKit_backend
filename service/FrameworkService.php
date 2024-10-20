<?php

include_once '../racine.php';
include_once RACINE . "/dao/IDao.php";
include_once RACINE . "/classes/Framework.php";
include_once RACINE . "/connexion/Connexion.php";

class FrameworkService implements IDao {

    private $connexion;

    public function __construct() {
        $this->connexion = (new Connexion())->getConnexion();
    }

    #[\Override]
    public function create($o) {
    $query = "INSERT INTO frameworks (name, descreption, domain, dependencies, image_path) 
              VALUES (:name, :descreption, :domain, :dependencies, :image_path)";
    $stmt = $this->connexion->prepare($query);
    
    // Debugging: Afficher les valeurs avant l'insertion
    echo "Name: " . $o->getName();
    echo "Description: " . $o->getDescreption();
    echo "Domain: " . $o->getDomain();
    echo "Dependencies: " . $o->getDependencies();
    echo "Image Path: " . $o->getImage_path();

    $stmt->bindValue(':name', $o->getName());
    $stmt->bindValue(':descreption', $o->getDescreption());
    $stmt->bindValue(':domain', $o->getDomain());
    $stmt->bindValue(':dependencies', $o->getDependencies());
    $stmt->bindValue(':image_path', $o->getImage_path());

    // Vérification de l'exécution
    if ($stmt->execute()) {
        return true;
    } else {
        echo "Error executing query: " . $stmt->errorInfo()[2]; // Affichez le message d'erreur
        return false;
    }
}

   /* public function create($o) {
        $query = "INSERT INTO frameworks (name, descreption, domain, dependencies, image_path) 
                  VALUES (:name, :descreption, :domain, :dependencies, :image_path)";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindValue(':name', $o->getName());
        $stmt->bindValue(':descreption', $o->getDescreption());
        $stmt->bindValue(':domain', $o->getDomain());
        $stmt->bindValue(':dependencies', $o->getDependencies());
        $stmt->bindValue(':image_path', $o->getImage_path());

        return $stmt->execute();
    }*/

    #[\Override]
      public function delete($id) {
         try {
        $query = "DELETE FROM frameworks WHERE id = :id";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (Exception $e) {
    
        return false;
    } 
    }

    #[\Override]
    public function findAll() {
        $query = "SELECT * FROM frameworks";
        $stmt = $this->connexion->query($query);
        $frameworks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach ($frameworks as $framework) {
            $result[] = [
                'id' => $framework['id'],
                'name' => $framework['name'],
                'descreption' => $framework['descreption'],
                'domain' => $framework['domain'],
                'dependencies' => $framework['dependencies'],
                'image_path' => $framework['image_path'],
                'created_at' => $framework['created_at'],
            ];
        }

        return $result;
    }

    #[\Override]
    public function findById($id) {
        $query = "SELECT * FROM frameworks WHERE id = :id";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); // Assurez-vous que l'id est bien un entier
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            
            return $row;
        }

        return null;
        }



    #[\Override]
    public function update($o) {
        $query = "UPDATE frameworks 
                  SET name = :name, descreption = :descreption, domain = :domain, 
                      dependencies = :dependencies, image_path = :image_path 
                  WHERE id = :id";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindValue(':name', $o->getName());
        $stmt->bindValue(':descreption', $o->getDescreption());
        $stmt->bindValue(':domain', $o->getDomain());
        $stmt->bindValue(':dependencies', $o->getDependencies());
        $stmt->bindValue(':image_path', $o->getImage_path());
        $stmt->bindValue(':id', $o->getId());

        return $stmt->execute();
    }
}
