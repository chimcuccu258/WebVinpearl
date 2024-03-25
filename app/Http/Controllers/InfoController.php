<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function show()
    {
        // Trong phương thức này, bạn có thể truy vấn dữ liệu cần thiết và truyền nó đến view
        $members = [

        ];

        return view('info', compact('members'));
    }
}