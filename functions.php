<?php 

	
	function createImageSource($src) {
		$type = strtolower(substr(strrchr($src,"."),1));
	  	if($type == 'jpeg') $type = 'jpg';
		if (preg_match('/jpg/', $type)) $img = imagecreatefromjpeg($src);
		if (preg_match('/png/', $type)) $img = imagecreatefrompng($src);
		if (preg_match('/gif/', $type)) $img = imagecreatefromgif($src);
		return $img;
	}

	function unionTooImg($src , $url  ,$intSrc_w ,$intDes_w , $intSrc_X , $intSrc_Y , $strNombres , $strApellidos , $strDpi){
		ob_start();
		$base = "./images/FRENTE.png";

		list($w, $h) = getimagesize($base);
		list($w2, $h2) = getimagesize($src);
		
		$destino = createImageSource($base);
		$origen = createImageSource($src);

		imagecopymerge(
			$destino, 
			$origen, 
			366 * ($w / $intDes_w), 
			31 * ($h / 400), 
			$intSrc_X * ($w2 / $intSrc_w), 
			$intSrc_Y * ($h2 / 400), 
			210 * ($w / $intDes_w), 
			210 * ($h / 400), 
			100);


		/***/

		$fuente = imageloadfont("./libs/arial.gdf");
		//nombres
		$nombres = @imagecreate(250 , 50)
			or die("Cannot Initialize new GD image stream");
		$color_fondo = imagecolorallocate($nombres, 30, 67, 104);		
		$color_text = imagecolorallocate($nombres, 255, 255, 255);
		$fuente = imageloadfont("./libs/arial.gdf");
		imagestring(
			$nombres, 
			$fuente, 
			125 - (round(strlen($strNombres)) * 6), 
			0,  
			strtoupper($strNombres) , 
			$color_text
		);
		imagestring(
			$nombres, 
			$fuente, 
			125 - (round(strlen($strApellidos)) * 6), 
			25,  
			strtoupper($strApellidos) , 
			$color_text
		);
		$new = imagecreatetruecolor(750, 150);
		imagecopyresampled($new, $nombres, 0, 0, 0, 0, 750, 150, 250, 50);

		//dpi	
		$dpi = @imagecreate(250 , 25)
			or die("Cannot Initialize new GD image stream");
		$color_fondo2 = imagecolorallocate($dpi, 161, 161, 161);
		$color_text2 = imagecolorallocate($dpi, 30, 67, 104);	
		imagestring(
			$dpi, 
			$fuente, 
			5, 
			0,  
			strtoupper($strDpi) , 
			$color_text2
		);

		$new2 = imagecreatetruecolor(750, 75);
		imagecopyresampled($new2, $dpi, 0, 0, 0, 0, 750, 75, 250, 25);


		//list($w, $h) = getimagesize($base);
		//$destino = createImageSource($base);
		imagecopymerge(
			$destino, 
			$new, 
			$w - 850, 
			$h - 400, 
			0, 
			0, 
			750, 
			150, 
			100);

		imagecopymerge(
			$destino, 
			$new2, 
			$w - 850, 
			$h - 130, 
			0, 
			0, 
			750, 
			75, 
			100);

		imagepng($destino);
		imagedestroy($destino);
		imagedestroy($dpi);		
		imagedestroy($new2);
		imagedestroy($nombres);
		imagedestroy($new);
		ImageDestroy($origen);

		/***/




	
		header("Content-Type: image/png");
		/*ImagePng($destino);
		ImageDestroy($destino);
		ImageDestroy($origen);*/

		$out = ob_get_contents(); // capturo la salida
		ob_end_clean();  // cierro buffer
		file_put_contents($url,$out);  // almaceno 
		return true;
	}

	function newImg($src) {
	  	list($w, $h) = getimagesize($src);
	  	list($wb, $hb) = getimagesize("./images/FRENTE.png");
	  	
	  	$img =  createImageSource($src);	  	

	 	$new = imagecreatetruecolor( $wb,$hb);
	 	$type = strtolower(substr(strrchr($src,"."),1));
	 	
	    if($type == "gif" or $type == "png"){
		    imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
		    imagealphablending($new, false);
		    imagesavealpha($new, true);
		}

		imagecopyresampled($new, $img, 0, 0, 0, 0, $wb, $hb, $w, $h);
	  	
		switch($type){
		    case 'bmp': imagewbmp($new, $src); break;
		    case 'gif': imagegif($new, $src); break;
		    case 'jpg': imagejpeg($new, $src); break;
		    case 'png': imagepng($new, $src); break;
		}
		return true;
	}

	function tetImg($base , $strNombres , $strApellidos , $strDpi){
		ob_start(); 
		
		$fuente = imageloadfont("./libs/arial.gdf");
		//nombres
		$nombres = @imagecreate(250 , 50)
			or die("Cannot Initialize new GD image stream");
		$color_fondo = imagecolorallocate($nombres, 30, 67, 104);		
		$color_text = imagecolorallocate($nombres, 255, 255, 255);
		$fuente = imageloadfont("./libs/arial.gdf");
		imagestring(
			$nombres, 
			$fuente, 
			125 - (round(strlen($strNombres)) * 6), 
			0,  
			strtoupper($strNombres) , 
			$color_text
		);
		imagestring(
			$nombres, 
			$fuente, 
			125 - (round(strlen($strApellidos)) * 6), 
			25,  
			strtoupper($strApellidos) , 
			$color_text
		);
		$new = imagecreatetruecolor(750, 150);
		imagecopyresampled($new, $nombres, 0, 0, 0, 0, 750, 150, 250, 50);

		//dpi	
		$dpi = @imagecreate(250 , 25)
			or die("Cannot Initialize new GD image stream");
		$color_fondo2 = imagecolorallocate($dpi, 161, 161, 161);
		$color_text2 = imagecolorallocate($dpi, 30, 67, 104);	
		imagestring(
			$dpi, 
			$fuente, 
			5, 
			0,  
			strtoupper($strDpi) , 
			$color_text2
		);

		$new2 = imagecreatetruecolor(750, 75);
		imagecopyresampled($new2, $dpi, 0, 0, 0, 0, 750, 75, 250, 25);


		list($w, $h) = getimagesize($base);
		$destino = createImageSource($base);
		imagecopymerge(
			$destino, 
			$new, 
			$w - 850, 
			$h - 400, 
			0, 
			0, 
			750, 
			150, 
			100);

		imagecopymerge(
			$destino, 
			$new2, 
			$w - 850, 
			$h - 130, 
			0, 
			0, 
			750, 
			75, 
			100);

		imagepng($destino);
		imagedestroy($destino);
		imagedestroy($dpi);		
		imagedestroy($new2);
		imagedestroy($nombres);
		imagedestroy($new);
		 
		$out = ob_get_contents(); // capturo la salida
		ob_end_clean();  // cierro buffer
		file_put_contents('arch/temp/datos.png',$out);  // almaceno 
 
	}

 ?>