<?php
    include 'enlaceBDySesion/bd.php';
    include 'enlaceBDySesion/sesion.php';
    function enviaCorreo ($correo){
        spl_autoload_register(function ($clase){
        $fullpath="/var/www/html/PHPMailer-master/src/".$clase.".php";
        if (file_exists($fullpath))
	        require_once $fullpath;
        else
    	    echo "<p>La clase $fullpath no se encuentra</p>";
        });

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP(); 
        $mail->Host = 'localhost';
        $mail->SMTPAuth = true; 
        $mail->Username = 'mario';
        $mail->Password = 'mario'; 
        $mail->Port = 587; 
            echo 'Pasado la configuración del objeto';
        try {
            $mail->setFrom('mario@mariodiaz.es', 'mario');
            $mail->addAddress($correo, '');
            $mail->Subject = 'ADMITIDO';
            $mail->Body = 'HAS SIDO ADMITIDO EN EL CURSO!';
            $mail->send();
        } catch (Exception $e) {
            echo 'El mensaje no pudo ser enviado.';
            echo 'Error de correo: ' . $mail->ErrorInfo;
        }
    }

    try {
        $boton = $_POST['boton'];
        
        if ($boton != "Aceptar") {
            $stmt = $enlace->prepare("select codigo, nombre, numeroplazas from cursos where abierto = 1");
            $stmt->execute();
            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>"; 
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Aceptar Solicitudes</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<h1>Aceptar Solicitudes</h1>";
                echo "<form action='?' method='post'>";
                echo "<table>";
                    echo "<tr><th>ID Curso</th><th>Nombre Curso</th><th>Nº Plazas</th><th>Aceptar Solicitudes</th></tr>";
                    while ($fila = $stmt->fetch(PDO::FETCH_NUM)) {
                        echo "<tr>";
                        foreach ($fila as $datos) {
                            echo "<td>$datos</td>";
                        }
                        echo "<td><input type='checkbox' name='cursos[]' value=$fila[0]></td>";
                        echo "</tr>";
                    }
                echo "</table>";
                echo "<input type='submit' name='boton' value='Aceptar'>";
                echo "</form>";
            echo "<button><a href='index.php'>Volver a Inicio</a></button>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        } else {
            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Aceptar Solicitudes</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<h1>Aceptar Solicitudes</h1>";
            $cursos = $_POST['cursos'] ?? [];
            //Me aseguro de que las solicitudes pertenezcan a un curso uniendo tablas y lo ordeno de forma desc por puntos
            $stmt2 = $enlace->prepare("select cursos.codigo, cursos.numeroplazas, solicitantes.dni, solicitantes.puntos, solicitantes.correo, solicitudes.admitido from cursos
                inner join solicitudes on cursos.codigo=solicitudes.codigocurso inner join solicitantes on solicitantes.dni=solicitudes.dni where cursos.codigo = (?)
                    group by cursos.codigo, solicitantes.dni order by solicitantes.puntos desc");
            $stmt2->bindParam(1, $cursos[0], PDO::PARAM_INT);
            $stmt2->execute();
            while ($fila2 = $stmt2->fetch(PDO::FETCH_NUM)) {
                if ($fila2[5]==0) {
                    $smt = $enlace->prepare("update solicitudes set admitido = admitido+1 where dni = (?) and codigocurso = (?)");
                    $smt->bindParam(1, $fila2[2], PDO::PARAM_STR);
                    $smt->bindParam(2, $fila2[0], PDO::PARAM_INT);
                    $smt->execute();
                    $smt2 = $enlace->prepare("update cursos set numeroplazas=numeroplazas-1 where codigo = (?)");
                    $smt2->bindParam(1, $fila2[0], PDO::PARAM_STR);
                    $smt2->execute();
                    enviaCorreo($fila2[4]);
                }
            }
            echo "<p style='color: green'>Solicitudes para el curso ".$cursos[0]." aceptadas</p>";
            echo "<button><a href='index.php'>Volver a Inicio</a></button>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        }
    } catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
?>