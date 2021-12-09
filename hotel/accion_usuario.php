<link href="../monitoreo/selector/select2.min.css" rel="stylesheet" />
<script src="../monitoreo/selector//select2.min.js"></script>

<script src="jquery/jquery-3.3.1.min.js"> </script>
<script src="popper/popper.min.js"> </script>
<script src="bootstrap/js/bootstrap.min.js"> </script>

<!-- datatables -->
<script type="text/javascript" src="../monitoreo/datatables/datatables.min.js"> </script>
<script type="text/javascript" src="../monitoreo/main.js"> </script>

<?php 
  require_once "../conexion/dbconnection.php";

//  accion guardar
if(isset($_POST['btnguardar']))
{
if( empty($_POST['txtnombre'] || $_POST['txtapellido'] || $_POST['txtdni'] || $_POST['txtusuario'] || $_POST['txttipo']))
    {
     //  $alert='<p> todos los campos son obligatorios</p>';
      echo '<div align="center" class="mb-4"> 
           <div class="alert alert-danger">
           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
           <strong>Error!</strong> todos los campos son obligatorios.
           </div>
           </div>';
    }
    else{
        $nombre=$_POST['txtnombre'];
        $apellido=$_POST['txtapellido'];
        $dni=$_POST['txtdni'];
        $tipo=$_POST['txttipo'];
        $usuario=$_POST['txtusuario'];
        $pass=md5($_POST['txtPassword']);
        $query=mysqli_query($sqlconnection,"INSERT INTO `tbl_usuario`(`NOMBRE`, `APELLIDO`, `DNI`, `TIPO`, `USUARIO`,`PASS`) VALUES ('$nombre','$apellido','$dni','$tipo','$usuario','$pass')");
   
         if($query)
         {
          clearstatcache();
           echo '<div align="center" class="mb-4">
                 <div class="alert alert-success">
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                 <strong>Correcto!</strong> registro exitoso.
                   </div>
                   </div>';
          

         }else
         {
           echo '<div align="center" class="mb-4">
                 <div class="alert alert-danger">
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                 <strong>Error!</strong> Error al guardar.
                 </div>
                 </div>';
         }
    }
   }
//   accion actualizar

 if(isset($_POST['btnactualizar']))
 {
 if(empty($_POST['dni']) || empty($_POST['nombre']))
     {
      //  $alert='<p> todos los campos son obligatorios</p>';
       echo '<div align="center" class="mb-4"> 
            <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> todos los campos son obligatorios.
            </div>
            </div>';
     }
     else{
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $dni=$_POST['dni'];
        $tipo=$_POST['tipo'];
        $usuario=$_POST['usuario'];
        $pass=md5($_POST['Password']);
        $query=mysqli_query($sqlconnection,"UPDATE `tbl_usuario` SET `NOMBRE`='$nombre',`APELLIDO`='$apellido',`DNI`='$dni',`TIPO`='$tipo',`USUARIO`='$usuario' ,`PASS`='$pass' WHERE `ID_USUARIO`='$id'");
    
          if($query)
          {
            clearstatcache();
            echo '<div align="center" class="mb-4">
                <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Correcto!</strong> Se actualizo correctamente.
                </div>
                </div>';
          }else
          {
            echo '<div align="center" class="mb-4">
                  <div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Error!</strong> Error al eliminar.
                  </div>
                  </div>';
          }
     }
    }
    //   accion eliminar
    if(isset($_GET['id']))
    {
    if(empty($_GET['id']))
        {
          //  $alert='<p> todos los campos son obligatorios</p>';
          echo '<div align="center" class="mb-4"> 
                <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error!</strong> no contine datos para eliminar.
                </div>
                </div>';
        }
        else{
            $id=$_GET['id'];
            $query="DELETE FROM `tbl_usuario` WHERE `ID_USUARIO`='$id'";
            if ($sqlconnection->query($query) === TRUE) {
              echo "deleted.";
              header("Location: mostrar_usuario.php"); 
              exit();
            } 
          else {
              //handle
              echo "someting wrong";
              echo $sqlconnection->error;
          }
        }
        }
 ?>
 
     <!-- registro de nivel -->
    <form class="signin-form" id="loginform" action="" method="POST">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><font style="vertical-align: inherit;">Registrar</font></h3>
                <button type="button" class="btn bg-info btn-sm  float-right" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
            </div>
              <div class="card-body">
                <div class="row">
                  <!--  -->
                <div class="col-4">
                <label for="txtnombre" >Nombres:</label>
                <input type="text" name="txtnombre" class="form-control"  id="txtnombre" placeholder="Ingrese su nombre" required>              
                </div>

                <div class="col-4">
                <label for="txtapellido">Apellidos:</label>
                <input type="text" name="txtapellido" class="form-control" id="txtapellido" placeholder="Ingrese su Apellido" required>
                </div>

                <div class="col-3">
                <label for="txtdni" >DNI:</label>
                <input type="text"  name="txtdni" maxlength="8" minlength="8"  class="form-control"  id="txtdni" placeholder="Ingrese su DNI" required  onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">              
                </div>
            
                <div class="col-4">
                <label for="txttipo" >Tipo de Usuario:</label>
                <select required aria-required="true" type="text" name="txttipo" class="custom-select " id="txttipo" >>
                <option value="">Seleccionar...</option>
                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                <option value="DIRECTOR">DIRECTOR</option>
                <option value="ESPECIALISTA">ESPECIALISTA</option>
                </select>
                </div>

                <div class="col-4">
                <label for="txtusuario">Usuario:</label>
                <input type="text" name="txtusuario" class="form-control" id="txtusuario" placeholder="Ingrese su Apellido" required>
                </div>

                <div class="col-3">
                <label>Ingrese una Contraseña :</label>
                <div class="input-group">
                <input ID="txtPassword" name="txtPassword" type="Password" value="" Class="form-control" placeholder="contraseña..." required>
                <div class="input-group-append">
                <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()" > <span class="fa fa-eye-slash icon" ></span> </button>
                </div>
                </div>
                </div>


                 <!--  -->
                </div>
              </div>
              <!-- /.card-body --> 
                <div  class="mb-4 text-center">
                <button type="submit" class=" btn btn-success" form="loginform" name="btnguardar" value="btnguardar">Guardar</button>
                </div> 
        </div>
    </form>
    <!-- registro final -->
  <!-- Modal --> 
  <div class="modal fade" id="meditar" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" >
                  <div class="modal-content" >
                    <div class="modal-header"style="background-color:#0D76F3">
                      <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR NIVEL</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                      <div class="modal-body">
                        <form action="" method="POST">
                        <div class="row">
                        <!-- inicio -->
                        <div class="col-8">
                        <label for="id" ></label>
                        <input type="hidden" name="id" class="form-control"  id="id" placeholder="Ingrese su nombre" required>              
                        </div>

                        <div class="col-8">
                        <label for="nombre" >Nombres:</label>
                        <input type="text" name="nombre" class="form-control"  id="nombre" placeholder="Ingrese su nombre" required>              
                        </div>

                        <div class="col-8">
                        <label for="apellido">Apellidos:</label>
                        <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Ingrese su Apellido" required>
                        </div>

                        <div class="col-8">
                        <label for="dni" >DNI:</label>
                        <input type="text" readonly name="dni" maxlength="8" minlength="8"  class="form-control"  id="dni" placeholder="Ingrese su DNI"  required  onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">              
                        </div>
                    
                        <div class="col-8">
                        <label for="tipo" >Tipo de Usuario:</label>
                        <select required aria-required="true" type="text" name="tipo" class="custom-select " id="tipo" >>
                        <option value="">Seleccionar...</option>
                        <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                        <option value="DIRECTOR">DIRECTOR</option>
                        <option value="ESPECIALISTA">ESPECIALISTA</option>
                        </select>
                        </div>

                        <div class="col-8">
                        <label for="usuario">Usuario:</label>
                        <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Ingrese usuario" required>
                        </div>

                        <div class="col-8">
                        <label>Ingrese una Contraseña :</label>
                        <div class="input-group">
                        <input ID="Password" name="Password" type="Password" value="" Class="form-control" placeholder="contraseña..." required>
                        <div class="input-group-append">
                        <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPass()" > <span class="fa fa-eye-slash icon" ></span> </button>
                        </div>
                        </div>
                        </div>
                        
                        <!--  fin-->
                        </div>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-danger"  data-dismiss="modal">CERRAR</button>
                              <button type="submit" class="btn btn-primary" name="btnactualizar" value="btnactualizar">ACTUALIZAR</button>
                              </div>
                        </form>
                    </div>
                    
                  </div>
                </div>
              </div>
              <!-- final de modal -->
    
    <!-- tabla de nivel docente -->
  <div class="card card-primary">
  <div class="card-header">
    NIVEL DEL DOCENTE
    <button type="button" class="btn bg-info btn-sm  float-right" data-card-widget="collapse">
    <i class="fas fa-minus"></i>
    </button>
    </div>
    <div class="card-body" cellspacing="0"> 
  
      <table id="IDESPECIALISTA" class=" table table-bordered" width="100%"  cellspacing="0" >
        <thead style="background-color: #049C85;color: white; font_weight: bold;">
              <tr>
                <td>ID</td>
                <td>NOMBRE</td>
                <td>APELLIDO</td>
                <td>DNI</td>
                <!-- <td style="display:none;">ID</td> -->
                <td>TIPO DE USUARIO</td>
                <td>USUARIO</td>
                <td>ACCIONES</td>
              </tr>
        </thead >
        <tbody>
        <?php
        require_once "../conexion/dbconnection.php";
        $sql_query = "SELECT * 
        FROM tbl_usuario";
        if($result = $sqlconnection ->query($sql_query))
        {
        while($obj = $result->fetch_object())
        {?>
        <tr>
        <td><?php echo $obj->ID_USUARIO;?></td>
        <td><?php echo $obj->NOMBRE;?></td>
        <td><?php echo $obj->APELLIDO;?></td>
        <td><?php echo $obj->DNI;?></td>
        <td><?php echo $obj->TIPO;?></td>
        <td><?php echo $obj->USUARIO;?></td>
        <td>
        <button type="button" class="btn btn-success btneditar" title="Editar" data-toggle="modal" data-target="#meditar">
        <i class="fas fa-edit nav-icon"></i></button>
        <!-- <button type='submit'class="btn btn-danger" name='eliminar' title="Eliminar" value='<?php echo $obj->ID_USUARIO;?>'>
        <i class="fas fa-trash-alt nav-icon"></i></button> -->
        <a onclick="return confirmDelete();" name='eliminar' href="accion_usuario.php?action=perfil&op=del&id=<?=$obj->ID_USUARIO;?>" class="btn btn-danger btn-xs">
        <i class="fa fa-trash"></i> Eliminar</a>
        </td>
        </tr>
        <?php }
        $result->close();
        }?>
        </tbody>
      </table>
    <div class="card-footer text-muted">
    Registro
  </div>
  </div>
  </div>


<!-- enviar datos -->
 <script>
 $('.btneditar').on('click', function() {
   $tr=$(this).closest('tr');
   var datos=$tr.children("td").map( function(){
      return $(this).text();
   });
   $('#id').val(datos[0]);
   $('#nombre').val(datos[1]);
   $('#apellido').val(datos[2]);
   $('#dni').val(datos[3]);
   $('#tipo').val(datos[4]);
   $('#usuario').val(datos[5]);
  
 })

</script>
<!-- 
<script>

$(document).ready(function() {
  $("#txtdni").select2({
    dropdownParent: $("#Modasignar")
  });
});

</script> -->
<!-- mostrarPassword -->
<script type="text/javascript">
function mostrarPassword(){
		var cambio = document.getElementById("txtPassword","");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 
	
	$(document).ready(function () {
	//CheckBox mostrar contraseña
	$('#ShowPassword').click(function () {
		$('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});
});
</script>
<!-- mostrarPass -->
<script type="text/javascript">
function mostrarPass(){
		var cambio = document.getElementById("Password","");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 
	
	$(document).ready(function () {
	//CheckBox mostrar contraseña
	$('#ShowPassword').click(function () {
		$('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});
});
</script>
<!-- datatable -->
<script>
$(document).ready(function(){
    $('#IDESPECIALISTA').DataTable({  
      "scrollY": 500,
      "scrollX": true ,          
    "language": {
    "lengthMenu": "Mostrar _MENU_ registros por pagina",
      //"info": "Mostrando pagina _PAGE_ de _PAGES_ / Mostrados: _START_ de _END_ ",
    "sInfo": "Mostrando: _START_ de _END_ - Total registros: _TOTAL_ ",
    "infoEmpty": "No hay registros disponibles",
    "infoFiltered": "(filtrada de _MAX_ registros)",
    "loadingRecords": "Cargando...",
    "processing": "Procesando...",
    "search": "Buscar:",
    "zeroRecords": "No se encontraron registros coincidentes",
    "paginate": {
    "next": "Siguiente",
    "previous": "Anterior",
    
  },
}
});
});
</script>
<!-- eliminar -->
<script type="text/javascript">
        function confirmDelete() {
            var confirmar = confirm("¿Realmente desea eliminarlo? ");
            if (confirmar) {
                return true;
            } else {
                return false;
            }
        }
</script>


