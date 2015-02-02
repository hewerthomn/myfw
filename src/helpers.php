<?php 

function dd($v, $die = true)
{
	echo '<pre>';
	var_dump($v);
	echo '</pre>';
	if($die) die;
}