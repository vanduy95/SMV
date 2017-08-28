<?php 
	function round_down($number)
 	{
 		$fig = (int) str_pad('1',7, '0');
 		return ((floor($number / $fig)) * $fig);
 	}
 ?>