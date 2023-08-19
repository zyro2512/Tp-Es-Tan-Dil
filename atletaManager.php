<?php
require_once('Atleta.php');
require_once('ArrayIdManager.php');

class AtletaManager extends ArrayIdManager{
    
	// Agregar atletas que ya estén en el sistema    
    public function cargaInicial(){
    	self::agregar(new Atleta(self::getNuevoId(), 'Juan', 'juan@example.com','04/06/1999'));
      self::agregar(new Atleta(self::getNuevoId(), 'María', 'maria@example.com','14/08/2000'));
      self::agregar(new Atleta(self::getNuevoId(), 'Pedro', 'pedro@example.com','12/03/1992'));
      self::agregar(new Atleta(self::getNuevoId(), 'José', 'jose@gmail.com','12/03/2001'));
    }
    
    
    public function getJSON() {
        $jsonAtletas = [];
        $atletas = $this->getArreglo();
    
        foreach ($atletas as $atleta) {
            $jsonAtletas[] = $atleta->toArray(); //método "toArray()" en la clase Atleta
        }
    
        $jsonString = json_encode($jsonAtletas, JSON_PRETTY_PRINT);
    
        $ids = $this->getIds();  // devuelve una cadena JSON válida con los IDs
    
        $finalJson = [
            "atletas" => $jsonAtletas,
            "ids" => json_decode($ids) // Decodificar la cadena JSON de IDs
        ];
    
        return json_encode($finalJson, JSON_PRETTY_PRINT);
    }
        
       
    //Crea el arreglo desde el archivo de texto
     public function setJSON($datos){
         $atletas = $jsonDatos->atletas;
         foreach ($atletas as $atleta) {
                $nuevoAtleta = new Atleta($atleta->id,$atleta->email, $atleta->fechaNacimiento);
                $this->agregarJSON($nuevoAtleta);
            }
    
    }
    
            
    // Actualizar los datos de un atleta por su ID
    
    public function actualizaratleta($id, $nombre, $email) {
		  $atletas = self::getArreglo();         
        foreach ($atletas as $atleta) {
            if ($atleta->getId() === $id) {
                $atleta->setNombre($nombre);
                $atleta->setEmail($email);
                break;
            }
        }
    }  

    // Mostrar por pantalla todos los atletas
	public function mostrarAtletas(){
		$atletas = self::getArreglo();
		foreach ($atletas as $atleta) {
	    	echo "ID: " . $atleta->getId() . ", Nombre: " . $atleta->getNombre() . ", Email: " . $atleta->getEmail() . ", Edad: " . $atleta->getEdad();
   	 	echo(PHP_EOL);
      }
      echo(PHP_EOL);
   }
}

/*
//Main para probar
// Crear el objeto del Administrador de Atleta
$atletaManager = new AtletaManager();
$atletaManager->cargaInicial();
$atletaManager->mostrarAtletas();
// Actualizar un Atleta
$atletaManager->actualizaratleta(2, 'María Rodríguez', 'maria.rodriguez@example.com','14/08/2001');
// Eliminar un Atleta
$atletaManager->eliminarPorId(3);
$atletaManager->mostrarAtletas();
  */  
?>