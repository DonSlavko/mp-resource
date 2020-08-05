<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string', 'max:255', Rule::in(['Apotheker/Apothekerin', 'Arzt/Ärztin'])],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'honorific' => ['required', 'string', 'max:255', Rule::in(['Herr', 'Frau'])],
            'titles' => ['nullable', 'string', 'max:255',
                Rule::in([
                    'Dipl.-Med.', 'Dr.', 'Dr. med.', 'Dr. rer. nat.', 'Dr. mult.', 'Drs.', 'Dr. Dr.',
                    'Dr. Dr. med.', 'Dipl. Ing.', 'Mag.', 'MBA', 'Ph.D.', 'Primar', 'Assoc. Prof.',
                    'Prof.', 'Prof. Dr.', 'Prof. Dr. h. c.', 'Prof. Dr. mult.', 'Prof. Dr. med.',
                    'Prof. Dr. Dr.', 'Prof. Dr. Dr. h. c.', 'Prof. Dr. Dr. h. c. mult.',
                    'Prof. Dr. Dr. med.',
                    ])
            ],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'pharmacy' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'postal' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'fax' => ['required', 'string', 'max:255'],

            'file1' => ['file', 'max:6144', 'mimetypes:application/pdf,image/jpeg,image/png'],
            'file2' => ['file', 'max:6144', 'mimetypes:application/pdf,image/jpeg,image/png'],
            'file3' => ['file', 'max:6144', 'mimetypes:application/pdf,image/jpeg,image/png'],

            'agree' => ['required'],
            'subscribe' => ['nullable'],
        ]);
    }

    protected function create(array $data)
    {
         $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'title' => $data['title'],
            'honorific' => $data['honorific'],
            'titles' => $data['titles'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'pharmacy' => $data['pharmacy'],
            'street' => $data['street'],
            'address' => $data['address'],
            'postal' => $data['postal'],
            'city' => $data['city'],
            'phone' => $data['phone'],
            'fax' => $data['fax'],
            'subscribed' => $data['subscribe'] ? 1 : 0,
        ]);

        $user->addMedia($data['file1']->path())
            ->setFileName($data['file1']->getClientOriginalName())
            ->toMediaCollection('upload_files');
        $user->addMedia($data['file2']->path())
            ->setFileName($data['file2']->getClientOriginalName())
            ->toMediaCollection('upload_files');
        $user->addMedia($data['file3']->path())
            ->setFileName($data['file3']->getClientOriginalName())
            ->toMediaCollection('upload_files');

        return $user;
    }

    public function checkIfExists(Request $request) {
        $email = $request->get('email', null);
        $username = $request->get('username', null);

        if ($username) {
            if (optional(User::where('username', $username)->first())->exists()) {
                return response(['value' => true]);
            }
        }

        if ($email) {
            if(optional(User::where('email', $email)->first())->exists()) {
                return response(['value' => true]);
            }
        }

        return response(['value' => false]);
    }
}
