<?php
namespace Clases;
use PDO,PDOException;

class Departamentos extends Conexion{
    private $id;
    private $nom_dep;

    public function __construct(){
        parent::__construct();
    }
    //------------------------CRUD--------------------------------
    public function create(){
        $c="insert into departamentos(nom_dep)values(:n)";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':n'=>$this->nom_dep
            ]);
        }catch(PDOException $ex){
            die("Error al insertar el departamento.Error: ".$ex->getMessage());
        }
    }
    public function update(){
        $c="update departamentos set nom_dep=:nd where id=:i";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':nd'=>$this->nom_dep,
                ':i'=>$this->id
            ]);
        }catch(PDOException $ex){
            die("Error al actualizar el Departamento: ".$ex->getMessage());
        }
    }
    public function read(){
        $c="select * from departamentos where id=:id";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':id'=>$this->id
            ]);
        }catch(PDOException $ex){
            die("Error al leer el departamento.Error: ".$ex->getMessage());
        }
        $fila=$stmt->fetch(PDO::FETCH_OBJ);
        return $fila;
    }
    public function delete(){
        $c="delete from departamentos where id=:id";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':id'=>$this->id
            ]);
        }catch(PDOException $ex){
            die("Error al eliminar el departamento.Error:".$ex->getMessage());
        }
    }
    //--------------Metodos adicionales---------------------------
    
    public function devolverTodos(){
        $c="select * from departamentos";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute();
        }catch(PDOExceptio $ex){
            die("Error al devolver los departamentos.Error:".$ex->getMessage());
        }
        return $stmt;
    }

    //ESTE METODO NO ES DEFINITIVO ES PROVISIONAL DEBIDO A SU CONFUSO FUNCIONAMIENTO
    public function devolverDepartamento(){
        $c="select nom_dep from departamentos where id=:id";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':id'=>$this->id
            ]);
        }catch(PDOException $ex){
            die("Error al devolver el departamento.Error:".$ex->getMessage());
        }
        return $stmt;
    }

    public function existeDepartamento($texto){
        $c="select * from departamentos where nom_dep=:t";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':t'=>$texto
            ]);
        }catch(PDOException $ex){
            die("Error al comprobar existencia del departamento: ". $ex->getMessage());
        }
        $fila=$stmt->fetch(PDO::FETCH_OBJ); 
        return ($fila==null) ? false : true;
    }
    //-----------------Getters %% Setters--------------------------
    /**
     * Get the value of nom_dep
     */ 
    public function getNom_dep()
    {
        return $this->nom_dep;
    }
    /**
     * Set the value of nom_dep
     *
     * @return  self
     */ 
    public function setNom_dep($nom_dep)
    {
        $this->nom_dep = $nom_dep;

        return $this;
    }
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}//FinClass