<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

            @unlink(public_path('upload/admin_images/'.$data->photo));

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

    public function changePassword()
    {
        $id = Auth::user()->id;
        $data = User::find($id);

        return view('admin.change_password', compact('data'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth::user()->getAuthPassword()))
        {
            $notification = array(
                'message' => "La vecchia password è sbagliata",
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        User::whereId(\auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => "Password Aggiornata",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
}
