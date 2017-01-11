<?php
    class Validate extends CI_Model{
        function get_input($data){
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
    }
?>
