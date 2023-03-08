<?php

namespace App\Http\Controllers;

use App\ViewModels\HomeViewModel;

class HomeController extends Controller
{
    public function index()
    {
        return view('index', new HomeViewModel());
    }
}
