<?php
    include 'enlaceBDySesion/bd.php';
    include 'enlaceBDySesion/sesion.php';

    $inicioSesion = $_SESSION['inicioSesion'];
    $esAdmin = $_SESSION['esAdmin'];

    if (isset($inicioSesion)){

        echo "<!DOCTYPE html>";
        echo "<html lang='es'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Gestiona Cursos</title>";
        echo "<link rel='stylesheet' href='css/estilo.css'>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
            $cerrar = $_GET['cerrar_sesion'];
            if (isset($cerrar)) {
                $_SESSION=array();
                setcookie('PHPSESSID','',time()-3600);
                session_destroy();
                header("Location: index.php");
            }
            if (!isset($inicioSesion)) {
                header("Location: index.php");
            }
            echo "<h1>BIENVENIDO!</h1>";
            echo "<h3>TU ID: ".$inicioSesion."</h3>";
            if ($esAdmin==1) {
                echo "<p class='centrar'>ADMIN</p>";
                echo "<button style='margin-left: 10px'><a href='anadirCurso.php'>Añadir Curso</a></button>";
                echo "<button style='margin-left: 10px'><a href='borrarCurso.php'>Borrar Curso</a></button>";
                echo "<button style='margin-left: 10px'><a href='activarDesactivarCurso.php'>Activar o Desactivar Curso</a></button>";
                echo "<button style='margin-left: 10px'><a href='admitidos.php'>Ver Admitidos</a></button>";
                echo "<button style='margin-left: 10px'><a href='aceptarSolicitudes.php'>Aceptar Solicitudes</a></button>";
                echo "<br><br><br>";
            }
            echo "<button style='margin-left: 10px'><a href='listaCursos.php'>Ver Lista Cursos</a></button>";
            echo "<button style='margin-left: 10px'><a href='index.php?cerrar_sesion=1'>Cerrar sesion</a></button><br>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
        
    } else {

        echo "<!DOCTYPE html>";
        echo "<html lang='es'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Gestion Cursos</title>";
        echo "<link rel='stylesheet' href='css/estilo.css'>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
            echo "<h1>GESTIONA CURSOS</h1>";
            echo "<button style='margin-left: 10px'><a href='listaCursos.php'>Ver Lista Cursos</a></button>";
            echo "<button style='margin-left: 10px'><a href='login.php'>Iniciar Sesion</a></button>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
        
    }
?>
<!--Espero que te guste mi proyecto-->
