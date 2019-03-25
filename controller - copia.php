<?php 
	require_once "functions.php";

	if (isset($_GET["save"])){
		$strXOrigin = isset($_POST["x"]) ? trim($_POST["x"]) : "";
		$strYOrigin = isset($_POST["y"]) ? trim($_POST["y"]) : "";
		$strXDestino = isset($_POST["x2"]) ? trim($_POST["x2"]) : "";
		$strYDestino = isset($_POST["y2"]) ? trim($_POST["y2"]) : "";
		$strAlto = isset($_POST["h"]) ? trim($_POST["h"]) : "";
		$strAncho = isset($_POST["w"]) ? trim($_POST["w"]) : "";

		print("save");
	}

	if (isset($_GET["upload"])) {
		 $banner=$_FILES['banner']['name']; 
		 $expbanner=explode('.',$banner);
		 $bannerexptype=$expbanner[1];
		 date_default_timezone_get();
		 $date = date('m/d/Yh:i:sa', time());
		 $rand=rand(10000,99999);
		 $encname=$date.$rand;
		 $bannername=md5($encname).'.'.$bannerexptype;
		 $bannerpath="uploads/banners/".$bannername;
		 move_uploaded_file($_FILES["banner"]["tmp_name"],$bannerpath);
	}

	if (isset($_GET["unir"])) {
		$name = "perfil-copia.jpg";
		$path = "./arch/".$name;
		$temp =  "./arch/temp/".$name;
		//move_uploaded_file($name, "./arch/temp/".$name );
		copy($path,$temp);

		if (true !== ($pic_error = @newImg($path))) {
		    echo $pic_error;
			unlink($path);
			return;
		}
		//else echo "OK!";
		//$img = "./arch/temp/".basename(unionTooImg("./images/FRENTE.png" , $temp));
		//copy($img  ,"./arch/temp/carnet.png");
		//move_uploaded_file("carne.png" , )
		print(unionTooImg("./images/FRENTE.png" , $temp));
	}

	if (isset($_GET["aplear"])) {

		$strName = isset($_GET["name"]) ? trim($_GET["name"]) : "";

		if( !empty($strName) ) {
			/*$path = "./arch/".$strName;
			$img = resizeImage($path);
			print($img);
			move_uploaded_file($img,"./arch/temp/".$strName);*/

			$path = "./arch/".$strName;
			//$pic_type = strtolower(strrchr($strName,"."));
			//$pic_name = "original$pic_type";
			move_uploaded_file($strName,  $path);
			if (true !== ($pic_error = @image_resize($path))) {
			    echo $pic_error;
				unlink($path);
			}
			else echo "OK!";
		} else {
			print("no hay nada");
		}
		
	}


	if (isset($_GET["recortar"])) {


		/*$strName = isset($_POST["name"]) ? trim($_POST["name"]) : "";
		$strXOrigin = isset($_POST["x"]) ? trim($_POST["x"]) : "";
		$strYOrigin = isset($_POST["y"]) ? trim($_POST["y"]) : "";
		$strXDestino = isset($_POST["x2"]) ? trim($_POST["x2"]) : "";
		$strYDestino = isset($_POST["y2"]) ? trim($_POST["y2"]) : "";
		$strAlto = isset($_POST["h"]) ? trim($_POST["h"]) : "";
		$strAncho = isset($_POST["w"]) ? trim($_POST["w"]) : "";

		if( !empty($strName) ) {
			//json_encode($arrData);
			//imagecopyresampled("./arch/temp/", "./arch/".$strName, $strXDestino, $strYDestino, $strXOrigin, $strYOrigin, $strAncho, $strAlto, $strAncho,$strAlto);
			/*print_r("./arch/temp/  ./arch/".$strName." ".$strXDestino." ".$strYDestino." ".$strXOrigin." ".$strYOrigin." ".$strAncho." ".$strAlto." ".$strAncho." ".$strAlto);

			print("success");
		} else {
			print("no hay nada");
		}*/

		/*list($width, $height, $type, $attr) = getimagesize("./arch/tux.jpg");
				ini_set("memory_limit", "1024M");
			  echo "Image width " . $width;
			  echo "Image height " . $height;
			  //imagecopyresampled("./arch/tux.jpg", "./arch/tux.jpg",278, 219, 68, 9, $width, $height ,210 ,210);
			  resizeImage("./arch/tux.jpg", $width , $height ,$width + 50 , $height + 50);
			//imagecopyresampled(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)*/




		
	}
 ?>