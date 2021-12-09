<?php
$alert='';

session_start();
if(!empty($_SESSION ['active']))
{
	header('location:hotel/');
}
else
{
if(!empty($_POST))
{
	require_once "conexion/dbconnection.php";

	$user=mysqli_real_escape_string($sqlconnection, $_POST['usuario']);
	$pass= MD5(mysqli_real_escape_string($sqlconnection,$_POST['password']));

	$SQL=mysqli_query($sqlconnection,"SELECT * FROM t_recepcionista WHERE USUARIO= '$user' AND PASS ='$pass'" );
	$result = mysqli_num_rows($SQL);
	if($result > 0)
	{
		$data=mysqli_fetch_array($SQL);
		session_start();
		$_SESSION['active']=true;
		$_SESSION['codrecepcionista']= $data['COD_RECEPCIONISTA'];
		$_SESSION['nombre']=$data['R_NOMBRE'];
		$_SESSION['apellido']=$data['R_APELLIDO'];
		$_SESSION['usuario']=$data['USUARIO'];
		$_SESSION['dni']=$data['R_DNI'];

		header('location:hotel/index.php');
	}
	else
	{
		echo '<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Error!</strong> El usuario o la contraseña es incorrecta.
	  	</div>';
		// $alert='El ususario o la contraseña es incorrecta';
	}

}
// else
// 	{
// 		$alert='error en el sistema vuelta a intentarlo';
// 	}
}

?>
<!doctype html>
<html lang="es">
  <head>
  	<title>HOTEL-BOLIVAR</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="login/css/style.css">
	<link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
	<link rel="stylesheet" type="text/css" href="datatables/DataTables-1.11.3/css/dataTables.bootstrap4.min.css"/>
	<link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
	<link href="../tabletas/selector/select2.min.css" rel="stylesheet" />
	<script src="../tabletas/selector//select2.min.js"></script>
	</head>
	<body class="img js-fullheight" style="background-image: url(login/images/hotel.jpeg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8 text-center mb-4">				
					<h1  class="display-1" style="color:white;" >HOPEDAJE-BOLIVAR</h1>				
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Sistema de ingreso al hotel bolivar?</h3>
		      	<form   action="" method="POST" class="signin-form" id="loginform">
		      		<div class="form-group">
		      			<input id="inputUsername" type="text" class="form-control"  name="usuario" placeholder="Usuario" required>
		      		</div>
	            <div class="form-group">
	              <input id="inputPassword" type="password" name="password" class="form-control" placeholder="Contraseña" required>
	              <span toggle="#inputPassword" class="fa fa-fw fa-eye field-icon toggle-password" ></span>
	            </div>				
	            <div  class="mb-4 text-center">
	            	<button type="submit" class=" btn btn-success" form="loginform" name="btnlogin" value="Ingresar">Ingresar</button>
	            </div>	            
	          </form>
		      </div>
				</div>
			</div>
		</div>
	</section>
	<script src="login/js/jquery.min.js"></script>
	<script src="login/js/popper.js"></script>
	<script src="login/js/bootstrap.min.js"></script>
	<script src="login/js/main.js"></script>

	</body>
</html>

