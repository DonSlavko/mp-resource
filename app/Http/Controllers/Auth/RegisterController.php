<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserRegister;
use App\Mail\UserRegisterAdmin;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
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

    protected function create(array $data) {
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

        $file1 = $data['file1'];
        $file2 = $data['file2'];
        $file3 = $data['file3'];

        if ($file1) {
            $name1 = time() . '_' . $file1->getClientOriginalName();
            $path1 = 'user/' . $user->username . '-' . $user->id . '/files/' . $name1;
            $file1->move('user/' . $user->username . '-' . $user->id . '/files/', $name1);
        }
        if ($file2) {
            $name2 = time() . '_' . $file2->getClientOriginalName();
            $path2 = 'user/' . $user->username . '-' . $user->id . '/files/' . $name2;
            $file2->move('user/' . $user->username . '-' . $user->id . '/files/', $name2);
        }
        if ($file3) {
            $name3 = time() . '_' . $file3->getClientOriginalName();
            $path3 = 'user/' . $user->username . '-' . $user->id . '/files/' . $name3;
            $file3->move('user/' . $user->username . '-' . $user->id . '/files/', $name3);
        }

        $user->update([
            'file1' => $name1,
            'file2' => $name2,
            'file3' => $name3,
        ]);

        $data = [
            'titles' => $data['titles'],
            'honorific' => $data['honorific'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
        ];

        Mail::to($data['email'])->send(new UserRegister($data));

        $files = [
            [
                'name' => $name1,
                'file' => $path1,
                'options' => [],
            ],
            [
                'name' => $name2,
                'file' => $path2,
                'options' => [],
            ],
            [
                'name' => $name3,
                'file' => $path3,
                'options' => [],
            ],
        ];

        $adminEmails = User::where('is_admin', 1)->pluck('email')->toArray();

        Mail::to($adminEmails)->send(new UserRegisterAdmin($user, $files));

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
            if (optional(User::where('email', $email)->first())->exists()) {
                return response(['value' => true]);
            }
        }

        return response(['value' => false]);
    }
}
