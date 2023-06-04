<?php
   error_reporting(0); //Evitar mensajes de error sql
   require "conecta.php";
   $con = conecta();

   $codigo    = trim($_POST['codigo']);

   //Comprobar disponibilidad
   $sql = "SELECT * FROM usuarios WHERE codigo = $codigo";
   $res   = mysqli_query($con, $sql);
   $filas = mysqli_num_rows($res); //Obtener numero de columnas
   session_start();

   if($filas) {
      $mensaje = "Código ya en uso";
   }
   else {
      $nombre    = trim($_POST['nombre']);
      $peso      = trim($_POST['peso']);
      $altura    = trim($_POST['altura']);
      $correo    = trim($_POST['correo']);
      $password  = trim($_POST['password']);
      
      $passwordC = md5($password);
      $fecha_nac = trim($_POST['fecha_nac']);

      $sql = "INSERT INTO usuarios (codigo, nombre, peso, altura, correo, password, fecha_nac)
      VALUES ('$codigo', '$nombre', '$peso', '$altura', '$correo', '$passwordC', '$fecha_nac')";

      mysqli_query($con, $sql);
      mysqli_close($con);

      $mensaje = "¡Registro creado con éxito!";
   }

   $_SESSION["mensaje"] = $mensaje;
   header("Location: ../index.php");
   exit();
   
?>