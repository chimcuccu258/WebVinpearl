<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeesRequest;
use App\Http\Requests\UpdateEmployeesRequest;
use App\Models\Employees;
use App\Models\TypeEmployees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchColumns = [
            'fullName' => 'like',
            'employeeId' => 'like',
            'phoneNumber' => 'like',
            'gender' => 'like',
        ];
        $column = $request->get('search_by');
        $keywords = $request->get('keywords');
        $lastKeyword = $keywords;
        $query = Employees::query();
        $query->leftJoin('typeEmployees', 'employees.typeEmployeeId', '=', 'typeEmployees.typeEmployeeId')
            ->select('employees.*', 'typeEmployees.employeeTypeName');

        if (array_key_exists($column, $searchColumns)) {
            $operator = $searchColumns[$column];
            if (!empty($keywords)) {
                if ($operator === 'like') {
                    $keywords = '%' . $keywords . '%';
                }
                $query->where($column, $operator, $keywords);
            }
        }

        //sắp xếp
        $sortableColumns = ['employeeId', 'fullName', 'phoneNumber', 'gender', 'birthday', 'address', 'employeeTypeName'];
        $defaultColumn = 'employeeId'; // Cột mặc định
        $defaultOrder = 'asc'; // Thứ tự mặc định

        $column = $request->get('sort_by', $defaultColumn);
        $order = $request->get('order', $defaultOrder);

        if (!in_array($column, $sortableColumns)) {
            $column = $defaultColumn;
        }

        $data = $query->orderBy($column, $order)->paginate(5);
        // Thêm tham số sắp xếp vào URL paginate
        $data->appends(['sort_by' => $column, 'order' => $order]);

        return view('admin.employees.index', [
            'employees' => $data,
            'keywords' => $lastKeyword,
            'column' => $column,
            'order' => $order,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typeEmployees = TypeEmployees::all();
        return view('admin.employees.create', ['typeEmployees' => $typeEmployees]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeesRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'avatar' . '.' . $image->getClientOriginalExtension();
            $data['image'] = $imageName;
        }
        $result = Employees::query()->create($data);
        if ($result) {
            return redirect()->route('employees.index')->with('success', 'Thêm thành công!');
        }
        return redirect()->route('employees.index')->with('error', 'Không thêm được khách hàng!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employees $employees)
    {
        return view('admin.employees.show', [
            'employees' => $employees,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employees $employees)
    {
        $typeEmployees = TypeEmployees::all();
        return view('admin.employees.edit', [
            'employees' => $employees,
            'typeEmployees' => $typeEmployees,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeesRequest $request, Employees $employees)
    {
        $employees->fill($request->validated());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $employeeID = $employees['employeeId'];
            $imageName = 'avatar' . '.' . $image->getClientOriginalExtension();
            $image->storeAs("public/images/employee_avt/$employeeID", $imageName);
            $employees['image'] = $imageName;
        }
        if ($employees->save()) {
            return redirect()->route('employees.index')->with('success', 'Cập nhật thông tin khách hàng thành công!');
        }
        return redirect()->route('employees.index')->with('error', 'Không thể cập nhật thông tin khách hàng!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($employeeId)
    {
        $result = Employees::query()->where('employeeId', $employeeId)->delete();
        if ($result) {
            return redirect()->route('employees.index')->with('success', 'Nhân viên đã được xóa thành công!');
        }
        return redirect()->route('employees.index')->with('error', 'Không tìm thấy nhân viên để xoá!');
    }
}