<?php 

	function createImageSource($src) {
		$type = strtolower(substr(strrchr($src,"."),1));
	  	if($type == 'jpeg') $type = 'jpg';
		//JPG
		if (preg_match('/jpg|jpeg/', $type)) $img = imagecreatefromjpeg($src);
		//PNG
		if (preg_match('/png/', $type)) $img = imagecreatefrompng($src);
		//JPG
		if (preg_match('/gif/', $type)) $img = imagecreatefromgif($src);
		return $img;
	}

	function generateBinaryDataFromImageData($image_data, $image_type) {
	    // Start with image buffer.
	    ob_start();

	    // Create image depending on image_type.
	    if ( preg_match( '/jpg|jpeg/', $image_type ) )
	        imagejpeg( $image_data );
	    if ( preg_match( '/png/', $image_type ) )
	        imagepng( $image_data );
	    if ( preg_match( '/gif/', $image_type ) )
	        imagegif( $image_data);

	    // Get image binary data.
	    $image_data = ob_get_clean();

	    // Clean temp object.
	    imagedestroy($image_data);

	    return $image_data;
	}


	function image_resize($src){

	  if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";

	  $type = strtolower(substr(strrchr($src,"."),1));
	  if($type == 'jpeg') $type = 'jpg';
	  switch($type){
	    case 'bmp': $img = imagecreatefromwbmp($src); break;
	    case 'gif': $img = imagecreatefromgif($src); break;
	    case 'jpg': $img = imagecreatefromjpeg($src); break;
	    case 'png': $img = imagecreatefrompng($src); break;
	    default : return "Unsupported picture type!";
	  }

	  $porcentaje = 1.1;
	  $width = $w * $porcentaje;
	  $height = $h * $porcentaje;

	  $new = imagecreatetruecolor($width, $height);

	  // preserve transparency
	  if($type == "gif" or $type == "png"){
	    imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
	    imagealphablending($new, false);
	    imagesavealpha($new, true);
	  }

	  imagecopyresampled($new, $img, 0, 0, 0, 0, $width, $height, $w, $h);

	  switch($type){
	    case 'bmp': imagewbmp($new, $src); break;
	    case 'gif': imagegif($new, $src); break;
	    case 'jpg': imagejpeg($new, $src); break;
	    case 'png': imagepng($new, $src); break;
	  }
	  return true;
	}

	function unionTooImg($src , $src2){
		ob_start();

		list($w, $h) = getimagesize($src);
		list($w2, $h2) = getimagesize($src2);

		
		$destino = createImageSource($src);
		$origen = createImageSource($src2);

		imagecopymerge(
			$destino, 
			$origen, 
			366 * ($w / 634.414), 
			31 * ($h / 400), 
			218 * ($w2 / 532.988), 
			130 * ($h2 / 400), 
			210 * ($h / 400), 
			210 * ($h / 400), 
			100);
		
		//Mostramos la imagen en el navegador
		header("Content-Type: image/png");
		ImagePng($destino);
		//Limpiamos la memoria utilizada con las imagenes
		ImageDestroy($destino);
		ImageDestroy($origen);


		$out = ob_get_contents(); // capturo la salida
		ob_end_clean();  // cierro buffer
		file_put_contents('./arch/temp/carne.png',$out);  // almaceno 
	}


	//function newImg($src , $width ,$height , $x , $y){
	function newImg($src) {
	  list($w, $h) = getimagesize($src);
	  list($wb, $hb) = getimagesize("images/FRENTE.png");

	  $img =  createImageSource($src);

	  $width = $wb;
	  $height = $hb;
	  $new = imagecreatetruecolor( $width,$height);

	  // preserve transparency
	  if($type == "gif" or $type == "png"){
	    imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
	    imagealphablending($new, false);
	    imagesavealpha($new, true);
	  }

	  //imagecopyresampled($new, $img, 0, 0, $x, $y, $width, $height, $w, $h);
	  //imagecopyresampled($new, $img, 0, 0, $x, $y, $width, $height, $wo, $ho);
	  imagecopyresampled($new, $img, 0, 0, 0, 0, $width, $height, $w, $h);

	  switch($type){
	    case 'bmp': imagewbmp($new, $src); break;
	    case 'gif': imagegif($new, $src); break;
	    case 'jpg': imagejpeg($new, $src); break;
	    case 'png': imagepng($new, $src); break;
	  }
	  return true;
	}
 ?>