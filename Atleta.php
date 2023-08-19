<?php

class Atleta {
    private $id;
    private $nombre;
    private $email;
    private $fechaNacimiento; //dd/mm/aaaa

    public function __construct($id, $nombre, $email, $fechaNacimiento) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->fechaNacimiento = new DateTime(date("d-m-Y"));
        $this->fechaNacimiento = DateTime::createFromFormat('d/m/Y',$fechaNacimiento);
   }

   public function toArray(){
    $arreglo = array( 
        "id" => $this->id,
        "nombre" => $this->nombre,
        "email" => $this->email,
        "FechadeNacimiento" => $this->fechaNacimiento);
    return $arreglo;
   }

    // Getters y Setters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getFechaNacimiento(){
        return $this->fechaNacimiento;
    }

    public function getEdad(){
        $nacimiento = $this->fechaNacimiento;
        $ahora = new DateTime(date("d-m-Y"));
        $diferencia = $ahora->diff($nacimiento);
        return $diferencia->format("%y");

    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setFechaNacimiento($fechaNacimiento){
        $this->fechaNacimiento = $fechaNacimiento;      
    }
}