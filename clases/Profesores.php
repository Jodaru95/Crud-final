<?php
namespace Clases;
use PDO,PDOException;

class Profesores extends Conexion{
    private $id;
    private $nom_prof;
    private $sueldo;
    private $fecha_prof;
    private $dep;

    public function __construct(){
        parent::__construct();
    }
    //------------------------CRUD--------------------------------
    public function create(){
        $c="insert into profesores(nom_prof,sueldo,fecha_prof,dep)values(:n,:s,now(),:d)";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':n'=>$this->nom_prof,
                ':s'=>$this->sueldo,
                ':d'=>$this->dep
            ]);
        }catch(PDOException $ex){
            die("Error al insertar el profesor.Error: ".$ex->getMessage());
        }
    }
    public function update(){
        $c="update profesores set nom_prof=:np,sueldo=:s,dep:d where id=:i";
        $stmt=parent::$conexion->prepare($c);
          try{
              $stmt->execute([
                  ':np'=>$this->nom_prof,
                  ':s'=>$this->sueldo,
                  ':d'=>$this->dep,
                  ':i'=>$this->id
              ]);
          }catch(PDOException $ex){
              die("error al actualizar el profesor: ".$ex->getMessage());
          }
    }
    public function read(){
        $c="select * from profesores where id=:id";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':id'=>$this->id
            ]);
        }catch(PDOException $ex){
            die("Error al leer el profesor.Error: ".$ex->getMessage());
        }
        $fila=$stmt->fetch(PDO::FETCH_OBJ);
        return $fila;
    }
    public function delete(){
        $c="delete from profesores where id=:id";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':id'=>$this->id
            ]);
        }catch(PDOException $ex){
            die("Error al eliminar el profesor.Error:".$ex->getMessage());
        }
    }
    //--------------Metodos adicionales---------------------------
    public function devolverTodo(){
        $c="select * from profesores";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error al devolver los profesores.Error:".$ex->getMessage());
        }
        return $stmt;
    }
    
    //-----------------Getters %% Setters--------------------------
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
    /**
     * Get the value of nom_prof
     */ 
    public function getNom_prof()
    {
        return $this->nom_prof;
    }
    /**
     * Set the value of nom_prof
     *
     * @return  self
     */ 
    public function setNom_prof($nom_prof)
    {
        $this->nom_prof = $nom_prof;

        return $this;
    }
    /**
     * Get the value of sueldo
     */ 
    public function getSueldo()
    {
        return $this->sueldo;
    }
    /**
     * Set the value of sueldo
     *
     * @return  self
     */ 
    public function setSueldo($sueldo)
    {
        $this->sueldo = $sueldo;

        return $this;
    }
    /**
     * Get the value of fecha_prof
     */ 
    public function getFecha_prof()
    {
        return $this->fecha_prof;
    }
    /**
     * Set the value of fecha_prof
     *
     * @return  self
     */ 
    public function setFecha_prof($fecha_prof)
    {
        $this->fecha_prof = $fecha_prof;

        return $this;
    }
    /**
     * Get the value of dep
     */ 
    public function getDep()
    {
        return $this->dep;
    }
    /**
     * Set the value of dep
     *
     * @return  self
     */ 
    public function setDep($dep)
    {
        $this->dep = $dep;

        return $this;
    }
}//FinClass