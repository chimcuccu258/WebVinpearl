<?php

namespace App\Http\Controllers;

use App\Models\BillDetails;
use App\Models\Bills;
use App\Models\Customers;
use App\Models\Services;
use App\Models\Tickets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileUserController extends Controller
{
    public function showProfile(Request $request)
    {
        $gender = 'Nam';
        if (Auth::user()->admin == 1) {
            $user = User::find(auth()->id());
            return view('profile.profile', [
                'user' => $user,
                'name' => $user->name,
                'gender' => '',
                'member' => 'Admin',
            ]);
        } else {
            $user = Customers::where('email', $request->user()->email)->first();
            $paymentHistory = Bills::where('customerId', $user->customerId)->get();
            $billDetails = BillDetails::all();
            $tickets = Tickets::all();
            $services = Services::all();
            if ($user->gender == 0) $gender = 'Nữ';
            return view('profile.profile', [
                'user' => $user,
                'name' => $user->fullName,
                'gender' => $gender,
                'member' => 'Thành viên',
                'paymentHistory' => $paymentHistory,
                'billDetails' => $billDetails,
                'tickets' => $tickets,
                'services' => $services,
            ]);
        }
    }
    public function edit(Request $request)
    {
        $gender = 'Nam';
        if (Auth::user()->admin == 1) {
            $user = User::find(auth()->id());
            return view('profile.edit', [
                'user' => $user,
                'name' => $user->name,
                'gender' => '',
                'member' => 'Admin',
            ]);
        } else {
            $user = Customers::where('email', $request->user()->email)->first();
            if ($user->gender == 0) $gender = 'Nữ';
            return view('profile.edit', [
                'user' => $user,
                'name' => $user->fullName,
                'gender' => $gender,
                'member' => 'Thành viên'
            ]);
        }
    }
    public function update(Request $request)
    {
        if ($request->has('submit')) {
            $customer = Customers::where('email', $request->user()->email)->first();
            $customer->fullName = $request->fullName;
            $customer->address = $request->address;
            $customer->phoneNumber = $request->phoneNumber;
            $customer->birthday = $request->birthday;
            $customer->gender = $request->input('gender');
            $customer->save();

            $user = User::find(\auth()->id());
            $user->name = $request->fullName;
            $user->save();

            return redirect()->route('show-profile')->with('update-success', 'Cập nhật thành công!');
        } else {
            return redirect()->route('show-profile');
        }
    }
}