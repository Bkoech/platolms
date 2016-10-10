<?php 

namespace App\Http\Controllers\Admin\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{

	/*
	|--------------------------------------------------------------------------
	| Tags Controller
	|--------------------------------------------------------------------------
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}

}
