<?php 
	function DatumRodenjaMysql($pickerDate){
		$date = DateTime::createFromFormat('Y-m-d', $pickerDate);
		return $date->format('d. m. Y');
	}  
    function DatumVijestiMysql($pickerDate){
		$date = DateTime::createFromFormat('Y-m-d H:i:s', $pickerDate);
		return $date->format('d. m. Y H:i');
	} 
?>