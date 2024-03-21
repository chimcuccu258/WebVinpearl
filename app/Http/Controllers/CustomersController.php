<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Http\Requests\StoreCustomersRequest;
use App\Http\Requests\UpdateCustomersRequest;
use App\Models\Customers;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchColumns = [
            'fullName' => 'like',
            'customerId' => 'like',
            'phoneNumber' => 'like',
        ];
        $column = $request->get('search_by');
        $keywords = $request->get('keywords');
        $lastKeyword = $keywords;
        $query = Customers::query();
        if (array_key_exists($column, $searchColumns)) {
            $operator = $searchColumns[$column];
            if (!empty($keywords)) {
                if ($operator === 'like') {
                    $keywords = '%' . $keywords . '%';
                }
                $query->where($column, $operator, $keywords);
            }
        }
        $data = $query->paginate(5);

        return view('admin.customers.index', [
            'customers' => $data,
            'keywords' => $lastKeyword,
            'column' => $column,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomersRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'avatar' . '.' . $image->getClientOriginalExtension();
            $data['image'] = $imageName;
        }
        $result = Customers::query()->create($data);
        if ($result) {
            return redirect()->route('customers.index')->with('success', 'Thêm thành công!');
        }
        return redirect()->route('customers.index')->with('error', 'Không thêm được khách hàng!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customers $customers)
    {
        return view('admin.customers.show', [
            'customers' => $customers,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customers $customers)
    {
        return view('admin.customers.edit', [
            'customers' => $customers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomersRequest $request, Customers $customers)
    {
        $customers->fill($request->validated());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $userId = $customers['customerId'];
            $imageName = 'avatar' . '.' . $image->getClientOriginalExtension();
            $image->storeAs("public/images/user_avt/$userId", $imageName);
            $customers['image'] = $imageName;
        }
        if ($customers->save()) {
            return redirect()->route('customers.index')->with('success', 'Cập nhật thông tin khách hàng thành công!');
        }
        return redirect()->route('customers.index')->with('error', 'Không thể cập nhật thông tin khách hàng!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($customerId)
    {
        $result = Customers::query()->where('customerId', $customerId)->delete();
        if ($result) {
            return redirect()->route('customers.index')->with('success', 'Khách hàng đã được xóa thành công!');
        }
        return redirect()->route('customers.index')->with('error', 'Không tìm thấy khách hàng để xoá!');
    }

    public function export()
    {
        return Excel::download(new CustomerExport(), 'khach-hangs' . '.xlsx');
    }
}