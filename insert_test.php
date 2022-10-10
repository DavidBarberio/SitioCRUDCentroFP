<?php
//http://localhost:8080/ejemploMYSQL/insert_test.php?DNI=1234N&Nombre=david&Apellido=Baasdf&Telefono=678678678
if (isset($_POST['DNI']) && isset($_POST['Nombre']) && isset($_POST['Apellido'])
    && isset($_POST['Telefono'])) {
        $DNI= $_POST['DNI'];
        $Nombre = $_POST['Nombre'];
        $Apellido = $_POST['Apellido'];
        $Telefono = $_POST['Telefono'];
    
    $mysqli = new mysqli("localhost", "root", "", "centro_fp");
    
    if ($mysqli->connect_errno) {
        echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    
    /* Sentencia preparada, etapa 1: preparación */
    if (!($sentencia = $mysqli->prepare("INSERT INTO alumnos (DNI, Nombre, Apellido, Telefono) VALUES (?, ?, ?, ?)"))) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    
    /* Sentencia preparada, etapa 2: vinculación y ejecución */
    if (!$sentencia->bind_param("ssss", $DNI, $Nombre, $Apellido, $Telefono)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    
    /* se recomienda el cierre explícito */
    $sentencia->close();
    
    /* Sentencia no preparada */
    $resultado = $mysqli->query("SELECT * FROM test");
    var_dump($resultado->fetch_all());
    
}else{
    echo("<br>Error en parametros<br>");
    
}



?>