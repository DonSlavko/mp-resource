<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\UserActivate;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::all()->load('media')->map(function ($user) {
            $user_files = [];

            if ($user->file1) {
                $user_files[] = [
                    'name' => $user->file1,
                    'path' => '/user/' . $user->username . '-' . $user->id . '/files/' . $user->file1,
                ];
            }

            if ($user->file2) {
                $user_files[] = [
                    'name' => $user->file2,
                    'path' => '/user/' . $user->username . '-' . $user->id . '/files/' . $user->file2
                ];
            }

            if ($user->file3) {
                $user_files[] = [
                    'name' => $user->file3,
                    'path' => '/user/' . $user->username . '-' . $user->id . '/files/' . $user->file3
                ];
            }

            $user->files = $user_files;

            return $user;
        })->toArray();

        return response(['data' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    public function update(Request $request, User $user) {
        try {
            $data = [];

            $request->exists('username') ? $request->get('username') : null;
            $request->exists('email') ? $data['email'] = $request->get('email') : null;
            $request->exists('titles') ? $data['titles'] = $request->get('titles') : null;
            $request->exists('honorific') ? $data['honorific'] = $request->get('honorific') : null;
            $request->exists('title') ? $data['title'] = $request->get('title') : null;
            $request->exists('first_name') ? $data['first_name'] = $request->get('first_name') : null;
            $request->exists('last_name') ? $data['last_name'] = $request->get('last_name') : null;
            $request->exists('pharmacy') ? $data['pharmacy'] = $request->get('pharmacy') : null;
            $request->exists('street') ? $data['street'] = $request->get('street') : null;
            $request->exists('address') ? $data['address'] = $request->get('address') : null;
            $request->exists('postal') ? $data['postal'] = $request->get('postal') : null;
            $request->exists('city') ? $data['city'] = $request->get('city') : null;
            $request->exists('phone') ? $data['phone'] = $request->get('phone') : null;
            $request->exists('fax') ? $data['fax'] = $request->get('fax') : null;


            $user->update($data);

            return response(['Benutzer wurde aktualisiert']);
        } catch (\Exception $exception) {
            return response(['message' => 'Es gab einen Fehler'], 500);
        }
    }


    public function activate(User $user) {

        $user->active = true;

        $user->save();

        Mail::to($user->email)->send(new UserActivate());

        return response(['data' => $user, 'message' => 'Benutzer aktiviert']);
    }

    public function deactivate(User $user) {
        $user->active = false;

        $user->save();

        return response(['data' => $user, 'message' => 'Benutzer deaktiviert']);
    }

    public function declinedUsers() {
        $users = User::where('active', 0)->get();

        return response(['data' => $users]);

    }

    public function destroy(User $user) {
        $user->delete();
        return response(['message' => 'Benutzer gelöscht']);
    }

    public function deleteAllUsers() {
        User::where('active', 0)->delete();
        return response(['message' => 'Accounts deleted']);
    }

    public function userOrders() {
        $orders = Auth::user()->userOrders->all();

        return response(['data' => $orders]);
    }

    public function userPreorders() {
        $orders = Auth::user()->userPreorders->all();

        return response(['data' => $orders]);
    }

    public function userPaymentStatus() {
        $paymentStatus = Auth::user()->paymentStatus->all();

        return response(['data' => $paymentStatus]);
    }
}
