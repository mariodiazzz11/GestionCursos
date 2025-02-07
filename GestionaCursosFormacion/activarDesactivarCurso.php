<?php
    include 'enlaceBDySesion/bd.php';
    include 'enlaceBDySesion/sesion.php';

    try {
        $boton = $_POST['boton'];
        $stmt = $enlace->prepare("select * from cursos where abierto = 1 and plazoinscripcion < CURDATE()");
        $stmt->execute();
        if ($boton != "Desactivar") {
            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Activar Desactivar</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<h1>Desactivar Cursos</h1>";
                echo "<form action='?' method='post'>";
                echo "<table>";
                echo "<tr><th>ID Curso</th><th>Nombre Curso</th><th>Activado</th><th>Nº de Plazas</th><th>Plazo de Inscripcion</th><th>Desactivar</th></tr>";
                    while ($fila = $stmt->fetch(PDO::FETCH_NUM)) {
                        echo "<tr>";
                        foreach ($fila as $value) {
                            echo "<td>$value</td>";
                        }
                        echo "<td><input type='checkbox' name='cursos[]' value=$fila[0]></td>";
                        echo "</tr>";
                    }
                echo "</form>";
                echo "</table>";
                echo "<tr>";
                echo "<input type='submit' name='boton' value='Desactivar'>";
                echo "<button><a href='index.php'>Volver a Inicio</a></button>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        } else {
            $resultado2 = $enlace->query("select * from cursos where abierto = 1 and plazoinscripcion < CURDATE()");
            $resultado2->execute();
            $cursos = $_POST['cursos'] ?? [];
            $sesion = $_SESSION['inicioSesion'];
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
            echo "<h1>Desactivar Cursos</h1>";
            echo "<table>";
            echo "<tr><th>ID Curso</th><th>Nombre Curso</th><th>Activado</th><th>Nº de Plazas</th><th>Plazo de Inscripcion</th></tr>";
                while ($fila2 = $resultado2->fetch(PDO::FETCH_NUM)) {
                    echo "<tr>";
                    foreach ($fila2 as $value2) {
                        echo "<td>$value2</td>";
                    }
                    echo "</tr>";
                }
            echo "</table>";
            //Probarlo
            if (count($cursos)>=1) {
                foreach ($cursos as $codigoCurso) {
                    $stmt2 = $enlace->prepare("select abierto from cursos where codigo = (?)");
                    $stmt2->bindParam(1, $codigoCurso, PDO::PARAM_INT);
                    $stmt2->execute();
                    while ($fila3 = $stmt2->fetch(PDO::FETCH_NUM)) {
                        if ($fila3[0]==0) {
                            $stmt3 = $enlace->prepare("update cursos set abierto=abierto+1 where codigo = (?)");
                            $stmt3->bindParam(1, $codigoCurso, PDO::PARAM_INT);
                            if ($stmt3->execute()) {
                                echo "<p style='color: green'>Curso activado</p>";
                            } else {
                                echo "<p style='color: red'>Error al activar el curso</p>";
                            }
                        } else {
                            $stmt4 = $enlace->prepare("update cursos set abierto=abierto-1 where codigo = (?)");
                            $stmt4->bindParam(1, $codigoCurso, PDO::PARAM_INT);
                            if ($stmt4->execute()) {
                                echo "<p style='color: green'>CURSO DESACTIVADO</p>";
                            } else {
                                echo "<p style='color: red'>Error al desactivar el curso</p>";
                            }
                        }
                    }
                }
            } else {
                echo "<p style='color: red'>NINGÚN CURSO SELECCIONADO</p>";
            }
            echo "<tr>";
            echo "<button><a href='activarDesactivarCurso.php'>Volver a Desactivar Cursos</a></button>";
            echo "<button><a href='index.php'>Volver a Inicio</a></button>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        }
    } catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
?>