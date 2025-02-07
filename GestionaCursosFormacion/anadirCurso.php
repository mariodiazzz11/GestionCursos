<?php
    include 'enlaceBDySesion/bd.php';
    include 'enlaceBDySesion/sesion.php';
    $boton = $_POST['boton'];
    $contador = 0;
    
    function pintaValores($tituloInput, $nombreInput){
        echo "$tituloInput: <input type='text' name='$nombreInput'>";
        echo "<br><br>";
    }

    function pintaFechas($tituloInput, $nombreInput){
        echo "$tituloInput: <input type='date' name=$nombreInput>";
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

    try{
            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>ActivarDesactivarCursos</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<h1>Añadir Curso</h1>";
        if($boton != "Insertar Curso"){
                echo "<form action='anadirCurso.php' method='post'>";
                pintaValores("Nombre del Curso", "nombreCurso");
                pintaValores("Nº de Plazas", "numeroPlazas");
                pintaFechas("Plazo Inscripcion","plazoInscripcion");
                echo "<input type='submit' name='boton' value='Insertar Curso'>";
                echo "</form>";
                echo "<tr>";
        }else{
            $nombreCurso = $_POST['nombreCurso'];
            $numeroPlazas = $_POST['numeroPlazas'];
            $plazoInscripcion = $_POST['plazoInscripcion'];
            $stmt = $enlace->prepare("insert into cursos(nombre,numeroplazas,plazoinscripcion) values(?,?,?)");
            $stmt->bindParam(1, $nombreCurso, PDO::PARAM_STR);
            $stmt->bindParam(2, $numeroPlazas, PDO::PARAM_STR);
            $stmt->bindParam(3, $plazoInscripcion, PDO::PARAM_STR);
            validaVacios("Nombre del Curso",$nombreCurso,"nombreCurso",$contador);
            echo "<br><br>";
            validaVacios("Nº de Plazas",$numeroPlazas,"numeroPlazas",$contador);
            echo "<br><br>";
            validaVacios("Plazo de Inscripcion",$plazoInscripcion,"plazoInscripcion",$contador);
            echo "<br><br>";
            if ($stmt->execute()) {
                echo "<p style='color: green'>Curso Añadido</p>";
            } else {
                echo "<p style='color: red'>Error al añadir el curso</p>";
            }
        }
        echo "<button><a href='index.php'>Volver a Inicio</a></button>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    }catch(PDOException $e){
        echo "<p style='color: red'>Error al añadir el curso</p>";
        echo "<button><a href='index.php'>Volver a Inicio</a></button>";

    }
?>