<?php
session_start();
//$_SESSION["DNIEmpleado"];
session_unset();
header("location: ../login.html");

