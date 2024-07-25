<?php

	function RestoreTransformations($Deger){
		$Bir 		= htmlspecialchars_decode($Deger, ENT_QUOTES); 
		$Sonuc 		= $Bir;
		return $Sonuc;
	}

	function SecurityFilter($Deger){
		$Bir 		= trim($Deger); 
		$Iki 		= strip_tags($Bir);
		$Uc		 	= htmlspecialchars($Iki, ENT_QUOTES);
		$Sonuc 		= $Uc;
		return $Sonuc;
	}

	function dateFoundMonth($num){
		$months = array(
			'January', 
			'February', 
			'March', 
			'April', 
			'May', 
			'June', 
			'July', 
			'August', 
			'September', 
			'October', 
			'November', 
			'December'
		);
		$Result = $months[$num-1];
		return $Result;
	}

	function dateFoundDayInWeekArray($num){
		$weeks = array( 
			'Sunday',
			'Monday', 
			'Tuesday', 
			'Wednesday', 
			'Thursday', 
			'Friday', 
			'Saturday'
		);
		$newWeeks = [];
		for($i = 0;$i < 7;$i++){
			if($num == 7){
				$num = 0;
			}
			$newWeeks[] = $weeks[$num];
			$num += 1;
		}
		$Result = $newWeeks;
		return $Result;
	}

	function ImgNameCreator(){
		$Sonuc			=	substr(md5(uniqid(time())), 0, 25);
		return $Sonuc;
	}

	function SEO($Deger, $ID){
		$degerIsimlendir 	= $Deger . " " . $ID;
		$Icerik 			= trim($degerIsimlendir);
		$Degisecekler 		= array("ç", "Ç", "ğ", "Ğ", "ı", "İ", "ö", "Ö", "ş", "Ş", "ü", "Ü");
		$Degisenler	 		= array("c", "C", "g", "G", "i", "I", "o", "O", "s", "S", "u", "U");
		$Icerik 			= str_replace($Degisecekler, $Degisenler, $Icerik);
		$Icerik				= mb_strtolower($Icerik, "UTF-8");
		$Icerik				= preg_replace("/[^a-z0-9]/", "-", $Icerik);
		$Icerik				= preg_replace("/-+/", "-", $Icerik);
		$Icerik 			= trim($Icerik, "-");
		return $Icerik;
	}

	function MD5toSalt($password,$salt){
		$md5Using = md5(($password . 31) . $salt . md5($salt));
		return $md5Using;
	}
?>