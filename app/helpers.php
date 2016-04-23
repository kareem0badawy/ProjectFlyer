<?php

function flash($title,$message)
{
	$flash = app('App\Http\Flash');

	return $flash->message($title,$message);
}