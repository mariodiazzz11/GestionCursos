<?php
    include 'enlaceBDySesion/bd.php';
    include 'enlaceBDySesion/sesion.php';

    try {
        $botonEnviar = $_POST['enviar'];
        $contador = 0;

        $consulta = "select * from solicitantes";
        $resultado = $enlace->query($consulta);
        
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
            }
        }

        if ($botonEnviar != "Iniciar Sesion") {

            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Iniciar Sesion</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<h1>Iniciar Sesión</h1>";
                echo "<form action='?' method='post'>";
                pintaValores("Usuario", "user");
                pintaValores("Password", "pass");
                echo "<input type='submit' name='enviar' value='Iniciar Sesion'>";
                echo "<button><a href='registro.php'>Registrarme</a></button>";
                echo "<button><a href='index.php'>Volver a Inicio</a></button>";
                echo "</form>";
            echo "</div>";
            echo "</body>";
            echo "</html>";

        } else {

            $user = $_POST['user'];
            $pass = $_POST['pass'];

            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Iniciar Sesion</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<h1>Iniciar Sesión</h1>";
                echo "<form action='?' method='post'>";
                validaVacios("Usuario", $user, "user", $contador);
                validaVacios("Password", $pass, "pass", $contador);
                if ($contador == 2 && $resultado->rowCount() > 0) {
                    $encontrado = false;
                    while ($fila = $resultado->fetch(PDO::FETCH_BOTH)) {
                        $dni=$fila[0];
                        $pass2 = $fila[16];
                        $esAdminis = $fila[17];
                        if ($user==$dni && $pass==$pass2) {
                            $encontrado = true;
                            $_SESSION['inicioSesion']=$user;
                            $_SESSION['esAdmin']=$esAdminis;
                            header("Location: index.php");
                            exit();
                        }
                    }
                    if (!$encontrado) {
                        echo "<p style='color: red'>CREDENCIALES INCORRECTOS</p>";
                    }
                }
                echo "<input type='submit' name='enviar' value='Iniciar Sesion'>";
                echo "<button><a href='registro.php'>Registrarme</a></button>";
                echo "<button><a href='index.php'>Volver a Inicio</a></button>";
                echo "</form>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        }
    } catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
?>