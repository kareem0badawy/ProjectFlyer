<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
/*
   public function __construct()
    {
		view()->share('signedIn',Auth::check());
    	view()->share('user',Auth::user());
    }*/

    protected $user;

	public function __construct()
		{

			$this->user = Auth::user();

			view()->share('signedIn', auth()->check());
			view()->share('user', $this->user);

		    //view()->share('signedIn', auth()->check()); // gives a $signedIn variable to all views

		    //view()->share('user', auth()->user()); // gives a $user variable to all views
		}
}
