<?php 
	require_once("controller.php");
	$user =  getUsuario($_GET["id"]);

	//print_r($user);
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
	<!--jcrop-->
	<link rel="stylesheet" type="text/css" href="./public/css/jcrop/jquery.Jcrop.css">
	<!--sweetalert-->
	<link rel="stylesheet" href="./public/css/sweetalert/sweetalert.css">
	<!--styles-->
	<link rel="stylesheet" href="./public/css/styles.css">


	<!--jquery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<!--jcrop-->
	<script src="./public/js/jcrop/jquery.Jcrop.js"></script>
	<!--sweetalert-->
	<script src="public/js/sweetalert/sweetalert.js"></script>
	<!--functions-->
	<script src="./public/js/functions.js"></script>
</head>
<body>
	<div class="container">
		<br>
		<div class="row" style="display: <?php  isset($user['url_carne_frente']) ? print('none') : print('');  ?>">			
			<div class="col-md-6">
				<img id="target-origin" height="400" src="images/FRENTE.png">
				<div id="recorte">
					
				</div>
			</div>
			<div class="col-md-1">
			</div>		
			<div class="col-md-5">
				<img height="400" id="target-user" src="<?php print($user['url_foto'])?>">
			</div>	
		</div>

		<div class="row" style="display: <?php  isset($user['url_carne_frente']) ? print('') : print('none');  ?>">		
			<img height="400" src="<?php print($user['url_carne_frente']) ?>" alt="">
		</div>

		<br>
		<div class="row" style="text-align: center;">			
			<div class="col-12">
				<a href="<?php print('index.php')?>" class="btn btn-danger">
					Regresar
				</a>
				<button class="btn btn-success" onclick="fntSaveImg(<?php print($_GET['id']); ?> , '<?php print($user['url_foto']); ?>' , '<?php print($user['nombres']); ?>'  ,  '<?php print($user['apellidos']); ?>' , '<?php print($user['dpi']); ?>' ) ">
					Guardar
				</button>				
			</div>
		</div>
	</div>
</body>
</html>


