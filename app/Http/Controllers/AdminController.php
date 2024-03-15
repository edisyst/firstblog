<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\User

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

        return view('admin.profile', compact('data');
    }
}
