<?php

class Framework {
    
    private $id;
    private $name;
    private $descreption;
    private $domain;
    private $dependencies;
    private $image_path;

    public function __construct($id, $name, $descreption, $domain, $dependencies, $image_path) {
        $this->id = $id;
        $this->name = $name;
        $this->descreption = $descreption;
        $this->domain = $domain;
        $this->dependencies = $dependencies;
        $this->image_path = $image_path;
    }
    
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescreption() {
        return $this->descreption;
    }

    public function getDomain() {
        return $this->domain;
    }

    public function getDependencies() {
        return $this->dependencies;
    }

    public function getImage_path() {
        return $this->image_path;
    }

   

    public function setName($name): void {
        $this->name = $name;
    }

    public function setDescreption($descreption): void {
        $this->descreption = $descreption;
    }

    public function setDomain($domain): void {
        $this->domain = $domain;
    }

    public function setDependencies($dependencies): void {
        $this->dependencies = $dependencies;
    }

    public function setImagePath($image_path): void { 
        $this->image_path = $image_path;
    }



    
    
}
