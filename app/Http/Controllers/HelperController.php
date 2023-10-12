<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HelperController extends Controller
{
    public function createLocation()
    {
        $branches = Branch::all();
        return view('location.index', compact('branches'));
    }

    public function saveLocation(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
        ]);
        Branch::insert([
            'name' => $request->name,
            'address' => $request->address,
        ]);
        return redirect()->back()->with("success", "Address created successfully!");
    }

    public function createUser()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function saveUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required',
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        User::create($input);
        return redirect()->back()->with("success", "User created successfully!");
    }
}
