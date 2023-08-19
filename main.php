<?php
 require_once('Menu.php');
 require_once('atletaManager.php'); 
 require_once('carreraManager.php');
  
  //Dar de alta un participante
  function altaParticipante($menu,$atletaManager){
        $nombre = $menu->readln("Ingrese nombre y apellido: ");
        $email = $menu->readln("Ingrese mail: ");
        $fechaNacimiento =  $menu->readln("Ingrese fecha de nacimiento, con el formato dd/mm/yyyy: ");
        $atleta = new Atleta($atletaManager->getNuevoId(),$nombre,$email,$fechaNacimiento);
        $atletaManager->agregar($atleta);
  }
 
  //Dar de alta una carrera  $id,$nombre,$circuito,$fecha,$precio,$kits
  function altaCarrera($menu,$carreraManager){
        $nombre = $menu->readln("Ingrese nombre carrera: ");
        $circuito = $menu->readln("Ingrese circuito: ");
        $fecha =  $menu->readln("Ingrese fecha de carrera, con el formato dd/mm/yyyy: ");
        $precio = $menu->readln("Ingrese precio de la carrera: ");
        $kits = new Kits();
        $rta = $menu->readln("La carrera entregará chip? S/N: ");
        if ($rta== 'S' || $rta == 's'){
                $kits->setChip(TRUE);
        }
        $rta = $menu->readln("La carrera entregará número? S/N: ");
        if ($rta== 'S' || $rta == 's'){
                $kits->setNumero(TRUE);
        }
        $rta = $menu->readln("La carrera entregará medalla? S/N: ");
        if ($rta== 'S' || $rta == 's'){
                $kits->setMedalla(TRUE);
        }
        $rta = $menu->readln("La carrera entregará remera? S/N: ");
        if ($rta== 'S' || $rta == 's'){
                $kits->setRemera(TRUE);
        }
        $carrera = new Carrera($carreraManager->getNuevoId(),$nombre,$circuito,$fecha, $precio,$kits);
        $carreraManager->agregar($carrera);
  }

  //Dar de baja un participante
  function bajaParticipante($menu,$atletaManager){
        $id = $menu->readln("Ingrese Id de atleta a elimiar: ");
        if($atletaManager->existeId($id)){
        		$atletaManager->eliminarPorId($id);
        	}else {
        		$menu->writeln("El id ingresado no se encuentra entre nuestros atletas");
        }
  }

   //Dar de baja una carrera
   function bajaCarrera($menu,$carreraManager){
        $id = $menu->readln("Ingrese Id de carrera a eliminar: ");
        if($carreraManager->existeId($id)){
        		$carreraManager->eliminarPorId($id);
        	}else {
        		$menu->writeln("El id ingresado no se encuentra entre nuestras carreras");
        }
  }

  //Modificar un participante
  function modificaParticipante($menu,$atletaManager){
        $id = $menu->readln("Ingrese Id de atleta a modificar: ");
        if($atletaManager->existeId($id)){
            $atletaModificado = $atletaManager->getPorId($id);         	   
        	   $menu->writeln("A continuación ingrese los nuevos datos, enter para dejarlos sin modificar");
        		$nombre = $menu->readln("Ingrese nombre y apellido: ");
        		if ($nombre != ""){
        			$atletaModificado->setNombre($nombre);
        		}
            $email = $menu->readln("Ingrese mail: ");
        		if ($email != ""){
        			$atletaModificado->setEmail($email);
        		}
            $fechaNacimiento =  $menu->readln("Ingrese fecha de nacimiento, con el formato dd/mm/yyyy: ");
            if ($fechaNacimiento != ""){
        			$atletaModificado->setFechaNacimiento($fechaNacimiento);
        		}
		      $atletaManager->modificar($atletaModificado);
        	}else {
        		$menu->writeln("El id ingresado no se encuentra entre nuestros atletas");
        }
  }

//Modifica un kits de una  carrera. $chip, $numero, $remera, $medalla
function modificaKits($menu,$carreraManager,$id){
        $kitsModificado = $carreraManager->getPorId($id)->getKits();
        $rta = $menu->readln("La carrera entregará chip? S/N: ");
        if ($rta== 'S' || $rta == 's'){
                $kitsModificado->setChip(TRUE);
        } elseif ($rta== 'N' || $rta == 'n'){
                $kitsModificado->setChip(FALSE);
        }
        $rta = $menu->readln("La carrera entregará número? S/N: ");
        if ($rta== 'S' || $rta == 's'){
                $kitsModificado->setNumero(TRUE);
        } elseif ($rta== 'N' || $rta == 'n'){
                $kitsModificado->setNumero(FALSE);
        }
        $rta = $menu->readln("La carrera entregará medalla? S/N: ");
        if ($rta== 'S' || $rta == 's'){
                $kitsModificado->setMedalla(TRUE);
        } elseif ($rta== 'N' || $rta == 'n'){
                $kitsModificado->setMedalla(FALSE);
        }
        $rta = $menu->readln("La carrera entregará remera? S/N: ");
        if ($rta== 'S' || $rta == 's'){
                $kitsModificado->setRemera(TRUE);
        } elseif ($rta== 'N' || $rta == 'n'){
                $kitsModificado->setRemera(FALSE);
        }
        return $kitsModificado;
}

//Modificar una carrera $id,$nombre,$circuito,$fecha,$precio,$kits
function modificaCarrera($menu,$carreraManager){
        $id = $menu->readln("Ingrese Id de carrera a modificar: ");
        if($carreraManager->existeId($id)){
                $carreraModificado = $carreraManager->getPorId($id);         	   
                $menu->writeln("A continuación ingrese los nuevos datos, enter para dejarlos sin modificar");
                $nombre = $menu->readln("Ingrese nombre: ");
                if ($nombre != ""){
        	        $carreraModificado->setNombre($nombre);
                }
                $circuito = $menu->readln("Ingrese circuito: ");
                if ($circuito != ""){
        	        $carreraModificado->setCircuito($circuito);
                }
                $fecha =  $menu->readln("Ingrese fecha de carrera, con el formato dd/mm/yyyy: ");
                if ($fecha != ""){
        		$carreraModificado->setFecha($fecha);
        	}
                $precio =  $menu->readln("Ingrese precio de carrera: ");
                if ($precio != ""){
        		$carreraModificado->setPrecio($precio);
        	}
                $kits = modificaKits($menu,$carreraManager,$id);
                $carreraModificado->setKits($kits);
                $carreraManager->modificar($carreraModificado);
        }else {
        	$menu->writeln("El id ingresado no se encuentra entre nuestros carreras");
        }
  }

  //Un administrador va a operar con participantes
  function ABMparticipantes($menu, $atletaManager){
        $opcion = $menu->ABMParticipantes();     //0 volver, 1 alta, 2 baja, 3 modificacion, 4 mostrar
        while ($opcion != 0){
            switch ($opcion) {
                case '1': 
                        altaParticipante($menu,$atletaManager);
                        break;
                case '2':
                        bajaParticipante($menu,$atletaManager);
                        break;
                case '3':
                        modificaParticipante($menu,$atletaManager);
                        break;
                case '4':
                        $atletaManager->mostrarAtletas();
                        break;
                default:
                       $menu->writeln("Tipo de operación inválida");
                       break;
                }
                $opcion = $menu->ABMParticipantes();     //0 volver, 1 alta, 2 baja, 3 modificacion, 4 mostrar
        }
    }

      //Un administrador va a operar con carreras
  function ABMcarreras($menu, $carreraManager){
        $opcion = $menu->ABMcarreras();     //0 volver, 1 alta, 2 baja, 3 modificacion, 4 mostrar
        while ($opcion != 0){
            switch ($opcion) {
                case '1': 
                        altaCarrera($menu,$carreraManager);
                        break;
                case '2':
                        bajaCarrera($menu,$carreraManager);
                        break;
                case '3':
                        modificaCarrera($menu,$carreraManager);
                        break;
                case '4':
                        $carreraManager->mostrarCarreras();
                        break;
                default:
                       $menu->writeln("Tipo de operación inválida");
                       break;
                }
                $opcion = $menu->ABMCarreras();     //0 volver, 1 alta, 2 baja, 3 modificacion, 4 mostrar
        }
    }

//Se le presentan todas las opciones para operar a un Administrador
  function operacionesAdmin($menu, $atletaManager, $carreraManager){
    $opcion = $menu->admin();     //0 volver, 1 carreras, 2 participantes, 3 pagos
    while ($opcion != 0){
        switch ($opcion) {
            case '1': 
                    ABMCarreras($menu,$carreraManager);
                    break;
            case '2':
                    ABMparticipantes($menu,$atletaManager);
                    break;
            case '3':
                    $menu->menuPagos();
                    break;
            default:
                   $menu->writeln("Tipo de operación inválida");
                   break;
            }
            $menu->admin();  //0 salir, 1 participante, 2 administrador
            $opcion = readline("opcion: ");
    }
}

//Se le presentan todas las opciones para operar a un participante
function operacionesParticipante($menu, $atletaManager){
	 $opcion = $menu->participante();     //0 volver, 1 carreras, 2 participantes, 3 pagos
    while ($opcion != 0){
		  $menu->cls();        
        switch ($opcion) {
            case '1': 
                    $menu->menuABMCarreras();
                    break;
            case '2':
                    $menu->menuABMParticipantes();
                    break;
            case '3':
                    $menu->menuPagos();
                    break;
            default:
                   $menu->writeln("Tipo de operación inválida");
                   break;
            }
            $opcion = $menu->participante();   //0 volver, 1 carreras, 2 participantes, 3 pagos
    }
}

//MAIN

$menu = new Menu;
$menu->cls();
$menu->pantallaBienvenida('Es-Tan-Dil');

$atletaManager = new AtletaManager();
$atletaManager->cargaInicial();
$atletaManager->grabar("datos/atletas.json");

$carreraManager = new CarreraManager();
$carreraManager->cargaInicial();
$carreraManager->grabar("datos/carreras.json");


// Leer el tipo de usuario seleccionado
$opcionTipoUsuario = $menu->elegirUsuario();  //0 salir, 1 participante, 2 administrador

while ($opcionTipoUsuario != 0){
    
     switch ($opcionTipoUsuario) {
        case '1': 
	       operacionesParticipante($menu,$atletaManager);
           break;
        case '2':
                operacionesAdmin($menu,$atletaManager,$carreraManager);
           break;
        default:
           $menu->writeln("Tipo de usuario inválido");
           break;
        }
        $opcionTipoUsuario = $menu->elegirUsuario();  //0 salir, 1 participante, 2 administrador;

    }
    $menu->pantallaDespedida();
?>
 