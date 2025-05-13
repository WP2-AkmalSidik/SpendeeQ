<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpenseController
{
    public function index()
    {
        return view('add-expense');
    }
}
