<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function show()
    {
        // Trong phương thức này, bạn có thể truy vấn dữ liệu cần thiết và truyền nó đến view
        $members = [
            ['id' => 1, 'name' => 'Vũ Minh Nga', 'studentId' => '63130803', 'tasks' => 'Updating...'],
            ['id' => 2, 'name' => 'Trần Hoàng Trọng', 'studentId' => '63135901', 'tasks' => 'Updating...'],
        ];

        return view('info', compact('members'));
    }
}