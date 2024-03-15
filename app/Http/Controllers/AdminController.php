<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.index');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function profile()
    {
        $id = Auth::user()->id;

        $data = User::find($id);

        return view('admin.profile', compact('data'));
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;

        $data = User::find($id);

        $data->username = $request->username;
        $data->name     = $request->name;
        $data->address  = $request->address;
        $data->phone    = $request->phone;
        $data->email    = $request->email;
//        $data->photo    = $request->showImage;

        if ($request->file('photo'))
        {
            $file = $request->file('photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => "Admin profile updated successfully!",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
