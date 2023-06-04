<?php
   session_start();
   $title = "Admin Ver Usuarios";
   $_SESSION['title'] = $title;
   include_once('../views/nav_admin.php');

   require "../funciones/conecta.php";
   $con = conecta();
   $sql = "SELECT * FROM usuarios ORDER BY nombre ASC";
   $res = $con->query($sql);
?>

<script src="../funciones/jquery-3.3.1.min.js"></script>
<script>
function Eliminacion(codigo) {
   var mensaje = "¿Estás seguro que deseas eliminar este registro?";
   var respuesta = confirm(mensaje);
   if(respuesta) {
      $.ajax({
      url      : 'admin_eliminar_usuarios.php?codigo='+codigo,
      type     : 'post',
      dataType : 'text',
      data     : 'codigo='+codigo,
      success : function(res) {
         if(res) {
            $('#fila'+codigo).remove(); //Eliminar la fila sin necesidad de actualizar navegador
            alert("Registro eliminado con éxito");
         } else {
            alert("Ocurrió un error, intenta más tarde");
         }
      }, error: function() {
         alert('Error, archivo no encontrado...');
      }
      });
   }
}
</script>
<div class="table_container">
   
   <a class="btn btn-primary" role="button" href="../users/user_registro_form.php" id="btn_new">
      Agregar nuevo usuario
   </a>

   <table class="table table-striped" border="2rem">
      <tr>
         <th colspan="9" id="title">Listado de usuarios</th>
      </tr>
      <tr class="table-headers bg-warning">
         <td>Código</td>
         <td>Nombre</td>
         <td>Peso</td>
         <td>Altura</td>
         <td>Correo</td>
         <td>Fecha nacimiento</td>
         <td colspan="3">Acciones</td>
      </tr>
      <?php
         while($row = $res->fetch_array()): 
            $codigo    = $row["codigo"];
            $nombre    = $row["nombre"];
            $peso      = $row["peso"];
            $altura    = $row["altura"];
            $correo    = $row["correo"];
            $fecha_nac = $row["fecha_nac"];

            $fecha_formato_mex = "$fecha_nac"; //Convertir a string
            $fecha_formato_mex = date("d-m-y", strtotime($fecha_formato_mex)); //Convertir de string a date en el formato dia/mes/año
      ?>
      <tr class="table_content" id="fila<?=$codigo;?>">
         <td> <?php echo $codigo; ?> </td>
         <td> <?php echo $nombre; ?> </td>
         <td> <?php echo $peso; ?> </td>
         <td> <?php echo $altura; ?> </td>
         <td> <?php echo $correo; ?> </td>
         <td> <?php echo $fecha_formato_mex; ?> </td>
         <td> <a href="admin_editar_form.php?codigo=<?=$codigo;?>">Editar</a><br> </td>
         <td> <a href="javascript:void(0);" onClick="Eliminacion(<?=$codigo;?>);">Eliminar</a> </td>
         <td> <a href="../admin/admin_registrar_pruebas.php?codigo=<?=$codigo;?>&nombre=<?=$nombre;?>">Registrar pruebas</a> </td>
      </tr>      
      <?php endwhile; ?>  
   </table>

</div>
</body>
</html>