<?php
class Usuario {
    public $nombre;
    public $email;

    public function __construct($nombre, $email) {
        $this->nombre = $nombre;
        $this->email = $email;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    
    $nuevoUsuario = new Usuario($nombre, $email);
    
    $archivo = 'usuarios.json';
    
    $usuarios = array();
    if (file_exists($archivo)) {
        $usuarios = json_decode(file_get_contents($archivo));
    }
    
    $usuarios[] = $nuevoUsuario;
    
    file_put_contents($archivo, json_encode($usuarios, JSON_PRETTY_PRINT));
    
    echo "Usuario registrado exitosamente.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuarios</title>
</head>
<body>

<h2>Registro de Usuario</h2>

<form method="post" action="">
    Nombre: <input type="text" name="nombre"><br>
    Email: <input type="text" name="email"><br>
    <input type="submit" value="Registrar">
</form>

</body>
</html>
