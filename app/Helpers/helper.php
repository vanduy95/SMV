<?php 
	function round_down($number)
 	{
 		$fig = (int) str_pad('1',7, '0');
 		return ((floor($number / $fig)) * $fig);
 	}
 	function orderId($retailsystem_id,$order_id)
 	{
 		return substr('0000000000000000000000'.$retailsystem_id,-3).substr('0000000000000000000000'.$order_id,-5);
 	}
 ?>