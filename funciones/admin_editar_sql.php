<?php
   require "conecta.php";
   $con = conecta();
   $codigo = $_REQUEST["codigo"];

   $nombre    = trim($_POST['nombre']);
   $peso      = trim($_POST['peso']);
   $altura    = trim($_POST['altura']);
   $correo    = trim($_POST['correo']);
   $password  = trim($_POST['password']);
   $passwordC = md5($password);
   
   $fecha_nac = trim($_POST['fecha_nac']);

   $sql = "UPDATE usuarios SET nombre = '$nombre', peso = $peso, altura = $altura, correo = '$correo',
   password = '$passwordC', fecha_nac = '$fecha_nac' WHERE codigo = $codigo";

   mysqli_query($con, $sql);
   mysqli_close($con);

   header("Location: ../admin/admin_ver_usuarios.php");
   exit();
?>