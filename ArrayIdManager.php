<?php
abstract class ArrayIdManager {
    private $arreglo;
    private $ids = 0;

    // Constructor
    public function __construct(){
        $this->arreglo = [];
    }

    // Según el tipo de objeto que contenga invocará a un diferente new, por eso es abstracta
    abstract function setJSON($datos); 

    //De un archivo lee el JSON     
     public function leer($nombreArchivo) {
        $datos = file_get_contents($nombreArchivo);
        $this->setJSON($datos);
    }    
    
     //Según el tipo de objeto que contenga invocará a un implode diferente
     abstract function getJSON();
      
     
     //Va a grabar en el archivo     
     public function grabar($nombreArchivo) {
        $datos = $this->getJSON();
        file_put_contents($nombreArchivo, $datos);
     }    
    
    // Agregar un objeto nuevo
    public function agregar($elemento) {
        $this->arreglo[] = $elemento;
        $this->ids ++;
        return $this->ids;
    }
    
    // Agregar un objeto que ya existía desde un JSON (no se incrementa el ids)
    public function agregarJSON($elemento) {
        $this->arreglo[] = $elemento;
    }


     /**
     * Set the value of ids
     */ 
    public function setIds($ids)
    {
        $this->ids = $ids;         
    }

   
    /**
     * Get the value of ids
     */ 
    public function getIds()
    {
        return $this->ids;
    }
    
    /**
     * Get the value of ids + 1, para crear un nuevo valor. No lo cambia por si la alta falla
     */ 
    public function getNuevoId()
    {
        $nuevoId = $this->ids+1;    	
        return $nuevoId;
    }
    
	//Busca si existe un id dentro de los elementos del arreglo	
	public function existeId($id){
		  foreach ($this->arreglo as $elemento) {
            if ($elemento->getId() == $id) {
                return TRUE;
            }
        }	
        return FALSE;	
	}

    // Eliminar un elemento por su ID
    public function eliminarPorId($id) {
        foreach ($this->arreglo as $key => $elemento) {
            if ($elemento->getId() == $id) {
                unset($this->arreglo[$key]);
                break;
            }
        }
    }


	  // Retorna por id el elemento, retorna NULL si no está
    public function getPorId($id) {
        foreach ($this->arreglo as $elemento) {
            if ($elemento->getId() == $id) {
                return $elemento;                
            }
        }
        return NULL;
    }
    
    //Va a modificar recibiendo un objeto, el id permanece
    public function modificar($elementoModificado) {
      $id = $elementoModificado->getId();
      if (self::existeId($id)){
      	foreach ($this->arreglo as $key => $elemento) {
            if ($elemento->getId() == $id) {
                $this->arreglo[$key] = $elementoModificado;
                break;
            }
         }
      }
    
    } 
        
    // Obtener arreglo
    protected function getArreglo() {
        return $this->arreglo;
    }
}
