<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use Illuminate\Http\Request;
use App\Models\User;

class InfoController extends Controller
{
    public function show()
    {
        $members = [];

        return view('info', compact('members'));
    }
}
