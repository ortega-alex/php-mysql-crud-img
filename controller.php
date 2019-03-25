<?php 
	require_once "functions.php";
	require_once "dbClass.php";

	//if (isset($_GET["get"])) {
	function getUsuarios() {
		$db = new dbClass();
		$strQuery = "SELECT a.* , b.*
					FROM usuario  a
					left JOIN foto_usuario b
					ON a.id = b.usuario";
		$qTMP = $db->db_consulta($strQuery);
		$arr = array();
		while ($rTMP = $db->db_fetch_array($qTMP)) {
			$arr[$rTMP["id"]]["id"] = $rTMP["id"];
			$arr[$rTMP["id"]]["nombres"] = $rTMP["nombres"];
			$arr[$rTMP["id"]]["apellidos"] = $rTMP["apellidos"];
			$arr[$rTMP["id"]]["codigo_sac"] = $rTMP["codigo_sac"];			
			$arr[$rTMP["id"]]["url_foto"] = $rTMP["url_foto"];
			$arr[$rTMP["id"]]["url_carne_frente"] = $rTMP["url_carne_frente"];
			$arr[$rTMP["id"]]["dpi"] = $rTMP["dpi"];
		}
        //$rTMP = $db->db_fetch_array($qTMP);
        $db->db_free_result($qTMP);
       	//print(json_encode($arr));
       	return $arr;
	}

	function getUsuario($intId) {
		$db = new dbClass();
		$strQuery = "SELECT a.* , b.*
					FROM foto_usuario a 
					INNER JOIN usuario b 
					ON a.usuario = b.id 
					WHERE usuario = {$intId}";
		$qTMP = $db->db_consulta($strQuery);
		$rTMP = $db->db_fetch_array($qTMP);
        $db->db_free_result($qTMP);
       	return $rTMP;
	}

	if (isset($_GET["set"])) {
		$arr["err"] = "true"; 
		$strNombres = isset($_POST["nombres"]) ? trim($_POST["nombres"]) : "";		
		$strApellidos = isset($_POST["apellidos"]) ? trim($_POST["apellidos"]) : "";
		$strDpi = isset($_POST["dpi"]) ? trim($_POST["dpi"]) : "";
		$intCodigo = isset($_POST["codigo"]) ? intval($_POST["codigo"]) : 0;
		
		if(!empty($strNombres) && !empty($strApellidos) && !empty($strDpi) && $intCodigo > 0 ) {
			
			$nombre = strtolower(str_replace(' ' , '_' , $strNombres." ".$strApellidos ).".".substr(strrchr($_FILES['imagen']['name'],"."),1));
			$ruta = "./upload/".$nombre;

			$resultado = move_uploaded_file($_FILES['imagen']['tmp_name'] , $ruta);
			
			if (!empty($resultado)){

	        	$db = new dbClass();

	            $strQuery = "INSERT INTO usuario (nombres , apellidos , codigo_sac , dpi)
							 VALUES ('{$strNombres}' , '{$strApellidos}' , {$intCodigo} , '{$strDpi}' ); ";
				$db->db_consulta($strQuery);
	            $intUsuario = $db->db_last_id();

				$strQuery = "INSERT INTO foto_usuario ( usuario , url_foto )
							 VALUES ( {$intUsuario} , '{$ruta}')";

				$db->db_consulta($strQuery);
				     
				$arr["err"] = "false";        
				$arr["msn"] = "el archivo ha sido movido exitosamente";
	            print(json_encode($arr));
            }else{
            	$arr["msn"] = "Error al subir el archivo";
	            print(json_encode($arr));
            }

		} else {
			$arr["msn"] = "Datos invalidos";
	        print(json_encode($arr));
		}
		die();
	}

	if (isset($_GET["save"])){
		
		$strNombres = isset($_POST["nombres"]) ? trim($_POST["nombres"]) : "";	
		$strApellidos = isset($_POST["apellidos"]) ? trim($_POST["apellidos"]) : "";	
		$strDpi = isset($_POST["dpi"]) ? trim($_POST["dpi"]) : "";	
		$strSrc = isset($_POST["src"]) ? trim($_POST["src"]) : "";		
		$intSrc_w = isset($_POST["src_w"]) ? intval($_POST["src_w"]) : 0;
		$intDes_w = isset($_POST["des_w"]) ? intval($_POST["des_w"]) : 0;
		$intSrc_X = isset($_POST["x"]) ? intval($_POST["x"]) : 0;
		$intSrc_Y = isset($_POST["y"]) ? intval($_POST["y"]) : 0;
		$intId = isset($_POST["id"]) ? intval($_POST["id"]) : 0;

		$name = explode("/" ,$strSrc)[2];
		$destino = "./upload/carne/".$name;

		if (true !== ($pic_error = @newImg($strSrc))) {
		    $arr["err"] = "true";         
			$arr["msn"] = $pic_error;
			print(json_encode($arr));
			die();
		}

		if (true !== ($pic_error = @unionTooImg($strSrc , $destino , $intSrc_w ,$intDes_w , $intSrc_X , $intSrc_Y , $strNombres , $strApellidos , "DPI: ".$strDpi))) {
		    $arr["err"] = "true";         
			$arr["msn"] = $pic_error;
			print(json_encode($arr));
			die();
		}
		
		$db = new dbClass();
		$strQuery = "UPDATE foto_usuario 
					 SET url_carne_frente = '{$destino}'
					 WHERE usuario = {$intId}";

		$db->db_consulta($strQuery);

	 	$arr["err"] = "false";         
		$arr["msn"] = "success";
		print(json_encode($arr));
		die();
	}

	
	if (isset($_GET["unir"])) {
		/*$name = "marlon_alexander_ortega_revolorio.jpg";
		$path = "./upload/".$name;
		$temp = "./upload/temp/".$name;
		$destino = "./upload/carne/".$name;
		
		copy($path,$temp);
		if (true !== ($pic_error = @newImg($path))) {
		    echo $pic_error;
			unlink($path);
			return;
		}*/
		//print(unionTooImg($temp , $destino));

		tetImg("./images/FRENTE.png" , $_GET["nombres"] , $_GET["apellidos"] , "DPI: 2271 02398 0101");

		
	}

 ?>