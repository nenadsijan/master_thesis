<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
class ChartsController extends Controller
{
     public function getCharts(){
	$path=file_get_contents("C:\Users\Sijan\Desktop\master6.7.2018\change_api_path\change_url.txt");

     	return view('charts.home',['path' => $path]);

     }

}
