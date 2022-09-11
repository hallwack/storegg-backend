<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $pageConfigs = ['blankPage' => true];

        return view('auth.login-cover', ['pageConfigs' => $pageConfigs]);
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return response()->json([
                    'message' => 'Login success !',
                    'results' => [
                        'user' => $request->user(),
                        'redirect' => url('admin/dashboard')
                    ],
                    'code' => 200,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }

        return response()->json([
            'message' => 'The provided credentials do not match our records !',
            'results' => [],
            'code' => 401,
        ], 401);
    }

    public function destroy(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
