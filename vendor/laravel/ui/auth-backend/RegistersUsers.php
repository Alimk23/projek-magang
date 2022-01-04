<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $getPhone = User::where('phone', $request['phone'])->first();
        $getEmail = User::where('email', $request['email'])->first();
        if (!empty($getPhone)) {            
            if (empty($getPhone->password)) {
                if (empty($getPhone->email)) {
                    $name = $getPhone->name;
                    $phone = $getPhone->phone;
                    $email = "";
                } else {
                    $name = $getPhone->name;
                    $phone = $getPhone->phone;
                    $email = $getPhone->email;
                }
                // dd($name,$email,$phone);
                // return view('auth.resetpass', compact('name','phone','email'));
            }
            elseif (!empty($getPhone->password)) {
                return redirect('/login')->with('error','Email atau no. HP sudah terdaftar, silahkan login atau lupa password');
            }
        }
        if (!empty($getEmail)) {            
            if (empty($getEmail->password)) {
                $name = $getEmail->name;
                $phone = $getEmail->phone;
                $email = $getEmail->email;
            }
            elseif (!empty($getEmail->password)) {
                return redirect('/login')->with('error','Email atau no. HP sudah terdaftar, silahkan login atau lupa password');
            }
        }

        else {
            event(new Registered($user = $this->create($request->all())));
    
            $this->guard()->login($user);
    
            if ($response = $this->registered($request, $user)) {
                return $response;
            }
    
            return $request->wantsJson()
                        ? new JsonResponse([], 201)
                        : redirect($this->redirectPath());
        }
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
