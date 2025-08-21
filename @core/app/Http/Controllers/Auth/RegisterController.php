<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Country;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class RegisterController extends Controller
{

    use RegistersUsers;

    public function redirectTo(){
        return route('homepage');
    }
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
    }

    protected function validator(array $data)
    {
        // if Google reCAPTCHA validation is needed
        $enableGoogleCaptcha = !empty(get_static_option('site_google_captcha_enable'));
        // validation rules
        $rules = [
            'name' => ['required', 'string', 'max:191'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],
            'agree_terms' => ['required'],
        ];
        // Add Google reCAPTCHA validation
        if ($enableGoogleCaptcha) {
            $rules['g-recaptcha-response'] = 'required';
        }
        // custom error messages
        $messages = [
            'g-recaptcha-response.required' => __('Google reCAPTCHA is required'),
            'name.required' => __('Name is required'),
            'name.max' => __('Name must be less than 191 characters'),
            'username.required' => __('Username is required'),
            'username.max' => __('Username must be less than 255 characters'),
            'username.unique' => __('Username is already taken'),
            'email.unique' => __('Email is already taken'),
            'email.required' => __('Email is required'),
            'password.required' => __('Password is required'),
            'password.confirmed' => __('Passwords do not match'),
            'agree_terms.required' => __('You must agree to our terms and conditions and privacy policies'),
        ];
        // Create the Validator instance
        $validator = Validator::make($data, $rules, $messages);

        // Validate the captcha_token conditionally
        if (!$enableGoogleCaptcha) {
            $validator->sometimes('captcha_token', function ($attribute, $value) {
                return !google_captcha_check($value);
            }, function ($validator) {
                $validator->errors()->add('captcha_token', __('Google reCAPTCHA verification failed'));
            });
        }

        // Return the Validator instance
        return $validator;
    }
    protected function adminValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:admins'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'country_id' => $data['country_id'],
            'city' => $data['city'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }
    protected function createAdmin(Request $request)
    {
        $this->adminValidator($request->all())->validate();
         Admin::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);


        return redirect()->route('admin.home');
    }

    public function showAdminRegistrationForm()
    {
        return view('auth.admin.register');
    }

    public function showRegistrationForm()
    {
        $all_countries = Country::select('id','name')->get();
        return view('frontend.user.register',compact('all_countries'));
    }
}
