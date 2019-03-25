<?php 
	include("controller.php");
	$usuarios = getUsuarios();
	//print_r($usuarios);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Carnet</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<!--sweetalert-->
	<link rel="stylesheet" href="./public/css/sweetalert/sweetalert.css">
	<!--styles-->
	<link rel="stylesheet" href="./public/css/styles.css">

	<!--jquery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<!--sweetalert-->
	<script src="public/js/sweetalert/sweetalert.js"></script>
	<!--functions-->
	<script src="./public/js/main.js"></script>
</head>
<body>
	<div class="container">
		<br>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<form class="form form-horizontal" onsubmit="return false" method="POST" id="uploadform" enctype="multipart/form-data">
					<div class="form-row">
						<div class="col-md-6">
							<label for="nombres">Codigo sac:</label>
							<input type="text" class="form-control" required autofocus placeholder="Codigo sac" name="codigo">
						</div>
						<div class="col-md-6">
							<label for="nombres">DPI:</label>
							<input type="text" class="form-control" required  placeholder="DPI" name="dpi">
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-6">
							<label for="nombres">Nombres:</label>
							<input type="text" class="form-control" required  placeholder="Nombres" name="nombres">
						</div>
						<div class="col-md-6">
							<label for="apelldos">Apellidos:</label>
							<input type="text" class="form-control" required  placeholder="Apellidos" name="apellidos">
						</div>
					</div>
			        <div class="form-row">
						<div class="col-md-6">
				        	<label for="imagen">Imagen:</label>
							<input type="file" name="imagen" id="imagen" class="form-control" value="" />
							<!--input type="submit" name="subirBtn" id="subirBtn" value="Subir imagen" class="btn btn-success" /-->
				        </div>
				       <div class="col-md-6" style="text-align: center;">
				       		<br>
				        	<button class="btn btn-success btn-sm" onclick="setUpload()">
				        		Guardar
				        	</button>
				        </div>
				    </div>
				</form>
			</div>

		</div>
		<br>
		<div class="row">
			<div class="col-md-6">
				<h1 class="h3">Usuarios</h1>
			</div>					
			<div class="col-md-6 text-right">
				<input type="text" class="form-control" placeholder="Buscar">
			</div>	
		</div>
		<div class="table-responsive table-hover">
            <table class="table table-sm">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombres</th>
						<th>Imagenes</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					<?php 

						 if( isset($usuarios) && is_array($usuarios) && count($usuarios) > 0 ){
                        	
						 	$index = 1;
						 	foreach ($usuarios as $key=>$usuario ) {

                                ?>
                                <tr>
                                    <td><?php print $index?></td>
                                    <td><?php print $usuario["nombres"]." ".$usuario["apellidos"]?></td>
                                    <td>
                                    	<img height="100" src="<?php  (empty($usuario['url_carne_frente'])) ? print($usuario['url_foto']) : print($usuario['url_carne_frente']) ?>">
                                    </td>
                                    <td nowrap>
                                    	<a class="btn btn-warning btn-sm" href="edit.php?id=<?php print($usuario["id"]); ?>">
                                    		<i class="far fa-edit"></i>
                                    		Edit
                                    	</a>
                                    </td>
                                </tr>
                                <?php
                                 $index++;
                            }                                       
                        } 
					 ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>