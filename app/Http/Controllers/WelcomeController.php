<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $companies = Company::orderBy('com_name')
            ->take(20)
            ->get();
            
        return view('welcome', ['companies' => $companies]);
    }
}