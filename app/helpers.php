<?php

function flash($message)
{
	return session()->flash('flash_message', $message);
}