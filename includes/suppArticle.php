<?php
	function suppArticle($tring){
		$tring = str_replace("Le","",$tring);
		$tring = str_replace("La","",$tring);
		$tring = str_replace("L'","",$tring);
		return $tring;
	}
?>