<?php
    include 'enlaceBDySesion/bd.php';
    include 'enlaceBDySesion/sesion.php';

    try {
        $boton = $_POST['boton'];
        if ($boton != "Enviar Inscripcion") {
            $consulta = "select codigo, nombre, numeroplazas, plazoinscripcion from cursos where abierto = 1";
            $resultado = $enlace->query($consulta);
            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Cursos</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<h1>CURSOS</h1>";
            echo "<form action='?' method='post'>";
                echo "<table>";
                    echo "<tr><th>ID Curso</th><th>Nombre</th><th>Nº de Plazas</th><th>Plazo de Inscripcion</th><th>Inscribirse</th></tr>";
                    while ($fila = $resultado->fetch(PDO::FETCH_NUM)) {
                        echo "<tr>";
                        foreach ($fila as $value) {
                            echo "<td>$value</td>";
                        }
                        echo "<td><input type='checkbox' name='cursos[]' value=$fila[0]></td>";
                        echo "</tr>";
                    }
                echo "</table>";
                echo "<tr>";
                echo "<input type='submit' name='boton' value='Enviar Inscripcion'>";
            echo "</form>";
            echo "<button><a href='index.php'>Volver a Inicio</a></button>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        } else {
            $consulta2 = "select codigo, nombre, numeroplazas, plazoinscripcion from cursos where abierto = 1";
            $resultado2 = $enlace->query($consulta2);
            $cursos = $_POST['cursos'] ?? [];
            $sesion = $_SESSION['inicioSesion'];
            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Cursos</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<h1>CURSOS</h1>";
            echo "<table>";
                echo "<tr><th>ID Curso</th><th>Nombre</th><th>Nº de Plazas</th><th>Plazo de Inscripcion</th></tr>";
                while ($fila = $resultado2->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    foreach ($fila as $value) {
                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                }
            echo "</table>";
            echo "<br>";
            if (count($cursos)!=1) {
                echo "<p style='color: red'>Selecciona 1 curso para matricularte</p>";
            } else {
                if (!isset($sesion)) {
                    echo "<p style='color: red'>Inicia sesión primero</p>";
                    header("Location: login.php");
                } else {
                    //Puedo hacer eso por que se que solo tiene un valor, si tuviera mas deberia de ejecutarlo con cada uno
                    //dentro del foreach para que itere por cada checkbox marcada
                    //$codigoCurso = $cursos[0];  // Si $cursos es un array con un solo valor
                    foreach ($cursos as $codigoCurso) {
                        //de esta manera iteramos solo una vez y nos aseguramos de que codigo curso tenga el curso
                        $fecha = date("Y-m-d");
                        // Preparamos la consulta
                        $stmt = $enlace->prepare("INSERT INTO solicitudes (dni, codigocurso, fechasolicitud) VALUES (?, ?, ?)");
                        // Vinculamos los parámetros antes de ejecutar
                        //Debemos vincularlos de esta manera o con bindValue o no dejará
                        //$stmt->bindParam("sss", $sesion, $codigoCurso, $fecha); de esta manera no funciona
                        $stmt->bindParam(1, $sesion, PDO::PARAM_STR);
                        $stmt->bindParam(2, $codigoCurso, PDO::PARAM_INT);
                        $stmt->bindParam(3, $fecha, PDO::PARAM_STR);
                        //Ejecutamos la consulta
                        if ($stmt->execute()) {
                            echo "<p style='color: green'>Incripción enviada correctamente para curso(ID): $codigoCurso.</p>";
                        } else {
                            echo "<p style='color: red'>Error: No se ha enviado la inscripción para el curso(ID): $codigoCurso.</p>";
                        }
                    }
                    //La pongo fuera y de manera preparada por que se duplicaban las restas
                    //y no realizaba bien la consulta update pero podria funcionar dentro
                    //$stmt2 = $enlace->prepare("update cursos set numeroplazas=numeroplazas-1 where codigo = (?)");
                    //$stmt2->bindParam(1, $codigoCurso, PDO::PARAM_INT);
                    //$stmt2->execute();
                }
            }
            echo "<button><a href='listaCursos.php'>Atrás</a></button>";
            echo "<button><a href='index.php'>Volver a Inicio</a></button>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        }
    } catch (PDOException $e) {
        echo "<p style='color: red'>Ya has solicitado el curso(ID): $codigoCurso.</p>";
        echo "<button><a href='listaCursos.php'>Atrás</a></button>";
        echo "<button><a href='index.php'>Volver a Inicio</a></button>";
    }
?>