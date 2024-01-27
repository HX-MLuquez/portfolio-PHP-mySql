<?php

  class conection {
    private $server= "localhost";
    private $user="root";
    private $password=""; //* de tener password se debe setear
    private $conection=null;

    public function __construct(){
        try {
            $this->conection= new PDO("mysql:host=$this->server;dbname=miporfolio",$this->user,$this->password);
            $this->conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $err) {
            error_log("Connection failed: " . $err->getMessage());
            throw $err; // Optionally rethrow the exception
        }
    }
    public function ejecutar($sql) { //* para INSERTAR datos
        if ($this->conection === null) {
            throw new Exception("No database connection");
        }
        $this->conection->exec($sql);
        return $this->conection->lastInsertId();
    }

    public function consultarProyectos($sql) { //* SELECT * FROM `proyectos` <- esta es la sentencia que le pasaremos por params para este caso
        $sentence=$this->conection->prepare($sql);
        $sentence->execute();
        return $sentence->fetchAll(); //* Retornamos todos los registros obtenidos con la sentencia sql pasada por params
    }

  }


?>