<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('time_to_string'))
{
	function time_to_string($waktu)
	{
		$waktu = gmdate("d M Y H:i:s",time() + 3600*24*7);
		return $waktu;
	}
}
