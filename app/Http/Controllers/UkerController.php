<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UkerController extends Controller
{
    public function edit()
    {
        $histories = History::latest()->get();
        return view('dashboard.uker.edit', compact('histories'));
    }
}
