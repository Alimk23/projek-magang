<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('reset');
    }
    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('auth.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'old_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    public function reset(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = User::where('email', $request->email)->first();
        $validationOldPassword = Hash::check($request->old_password, $user->password);
        if ($validationOldPassword) {
            $update = $user->update([                
                'password' => Hash::make($request->password),
            ]);
            if ($update) {
                return redirect('/login')->with('success','Reset password berhasil, silahkan login.');
            }
            else {
                return redirect('/password/reset')->with('error','Maaf, terjadi kesalahan sistem. Reset password gagal');
            }
        }
        else {
            return redirect('/password/reset')->with('error','Password lama tidak sama dengan yang berada di database kami');
        }
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
}
