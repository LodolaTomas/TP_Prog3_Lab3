<?php

session_start();
function ValidarSesion()
{
    if ($_SESSION["DNIEmpleado"] == false) {
        header("location: ../login.html");
    } else {
        echo "<b>Sesion existente</b>";
    }
}

ValidarSesion();