<?php

try{
    function pintaValores($tituloInput, $nombreInput){
        echo "$tituloInput: <input type='text' name='$nombreInput'>";
        echo "<br><br>";
    }

    function validaVacios($tituloInput, $variable, $nombreInput, &$contadorParam){
        if(!empty($variable)){
            echo "$tituloInput: <input type='text' name='$nombreInput' value='$variable'>";
            $contadorParam++;
        }else{
            echo "$tituloInput: <input type='text' name='$nombreInput'>";
            echo "<br>";
            echo "<small style='color: red'>Valor no válido</small>";
            echo "<br>";
        }
    }

    function validaFechas($tituloInput, $variable, $nombreInput, &$contadorParam){
        if(!empty($variable)){
            echo "$tituloInput: <input type='date' name='$nombreInput' value='$variable'>";
            $contadorParam++;
        }else{
            echo "$tituloInput: <input type='date' name='$nombreInput'>";
            echo "<br>";
            echo "<small style='color: red'>Valor no válido</small>";
            echo "<br>";
        }
    }

    function pintaFechas($tituloInput, $nombreInput){
        echo "$tituloInput: <input type='date' name=$nombreInput>";
        echo "<br><br>";
    }

    $boton = $_POST['boton'];
    include 'enlaceBDySesion/bd.php';
    include 'enlaceBDySesion/sesion.php';
    echo "<!DOCTYPE html>";
    echo "<html lang='es'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Registro</title>";
    echo "<link rel='stylesheet' href='css/estilo.css'>";
    echo "</head>";
    echo "<body>";
    if ($boton != "Enviar") {
        echo "<div class='container'>";
        echo "<h1>Registro</h1>";
            echo "<form action='registro.php' method='post'>";
            pintaValores("DNI", "dni");
            pintaValores("Password", "pass");
            pintaValores("Apellidos", "apellidos");
            pintaValores("Nombre", "nombre");
            pintaValores("Telefono", "telefono");
            pintaValores("Correo", "correo");
            pintaValores("Codigo Centro", "codigoCentro");
            pintaValores("Nombre Grupo", "nombreGrupo");
            pintaValores("Pbilin", "pbilin");
            pintaValores("Cargo", "cargo");
            pintaValores("Nombre Cargo", "nombreCargo");
            pintaValores("Situacion", "situacion");
            pintaFechas("Fecha Nacimiento", "fechaNacimiento");
            pintaValores("Especialidad", "especialidad");
            echo "<input type='submit' name='boton' value='Enviar'>";
            echo "<button><a href='index.php'>Volver a Inicio</a></button>";
            echo "</form>";
        echo "</div>";

    } else {
        echo "<div class='container'>";
        echo "<h1>Registro de Usuario</h1>";
        echo "<form action='registro.php' method='post'>";
            $dni = $_POST['dni'];
            $password = $_POST['pass'];
            $apellidos = $_POST['apellidos'];
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
            $codigoCentro = $_POST['codigoCentro'];
            //$coordinadorTC = $_POST['coordinadorTC'];
            //$grupoTC = $_POST['grupoTC'];
            $coordinadorTC = 0;
            $grupoTC = 0;
            $nombreGrupo = $_POST['nombreGrupo'];
            $pbilin = $_POST['pbilin'];
            $cargo = $_POST['cargo'];
            $nombreCargo = $_POST['nombreCargo'];
            $situacion = $_POST['situacion'];
            $fechaNacimiento = $_POST['fechaNacimiento'];
            $especialidad = $_POST['especialidad'];
            $contador = 0;
            $puntos = 0;
            $admin = 0;


            $stmt = $enlace->prepare("insert into solicitantes(dni,apellidos,nombre,telefono,correo,codigocentro,coordinadortc,grupotc,nombregrupo,pbilin,cargo,nombrecargo,situacion,
                                            fechanac,especialidad,puntos,password,admin) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bindParam(1, $dni, PDO::PARAM_STR);
            $stmt->bindParam(2, $apellidos, PDO::PARAM_STR);
            $stmt->bindParam(3, $nombre, PDO::PARAM_STR);
            $stmt->bindParam(4, $telefono, PDO::PARAM_STR);
            $stmt->bindParam(5, $correo, PDO::PARAM_STR);
            $stmt->bindParam(6, $codigoCentro, PDO::PARAM_STR);
            $stmt->bindParam(7, $coordinadorTC, PDO::PARAM_STR);
            $stmt->bindParam(8, $grupoTC, PDO::PARAM_STR);
            $stmt->bindParam(9, $nombreGrupo, PDO::PARAM_STR);
            $stmt->bindParam(10, $pbilin, PDO::PARAM_STR);
            $stmt->bindParam(11, $cargo, PDO::PARAM_STR);
            $stmt->bindParam(12, $nombreCargo, PDO::PARAM_STR);
            $stmt->bindParam(13, $situacion, PDO::PARAM_STR);
            $stmt->bindParam(14, $fechaNacimiento, PDO::PARAM_STR);
            $stmt->bindParam(15, $especialidad, PDO::PARAM_STR);
            $stmt->bindParam(16, $puntos, PDO::PARAM_STR);
            $stmt->bindParam(17, $password, PDO::PARAM_STR);
            $stmt->bindParam(18, $admin, PDO::PARAM_INT);

            validaVacios("DNI",$dni,"dni",$contador);
            validaVacios("Password",$password,"pass",$contador);
            validaVacios("Apellidos",$apellidos,"apellidos",$contador);
            validaVacios("Nombre",$nombre,"nombre",$contador);
            validaVacios("Telefono",$telefono,"telefono",$contador);
            validaVacios("Correo",$correo,"correo",$contador);
            validaVacios("Codigo Centro",$codigoCentro,"codigoCentro",$contador);
            //validaVacios("Coordinador TC",$coordinadorTC,"coordinadorTC",$contador);
            //validaVacios("Grupo TC",$grupoTC,"grupoTC",$contador);
            validaVacios("Nombre Grupo",$nombreGrupo,"nombreGrupo",$contador);
            validaVacios("Pbilin",$pbilin,"pbilin",$contador);
            validaVacios("Cargo",$cargo,"cargo",$contador);
            validaVacios("Nombre Cargo",$nombreCargo,"nombreCargo",$contador);
            validaVacios("Situacion",$situacion,"situacion",$contador);
            validaFechas("Fecha Nacimiento",$fechaNacimiento,"fechaNacimiento",$contador);
            validaVacios("Especialidad",$especialidad,"especialidad",$contador);

            if($contador == 14){
                if ($stmt->execute()) {
                    echo "<p style='color: green'>Registro completado</p>";
                } else {
                    echo "<p style='color: red'>Registro fallido</p>";
                }
            }else{
                echo "<input type='submit' name='boton' value='Enviar'>";
            }
            echo "<button><a href='index.php'>Volver a Inicio</a></button>";
            echo "</form>";
            echo "</div>";
    }
        echo "</body>";
        echo "</html>";
}catch(PDOException $e){
   echo "<p style='color: red'>Usuario con DNI: " . $dni . " ya registrado</p>";
   echo "<button><a href='index.php'>Volver a Inicio</a></button>";
}
?>