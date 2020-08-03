<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->load('media')->map(function ($user) {
            $uploads = $user->getMedia('upload_files');

            if (!$uploads->isEmpty()) {
                $user->file_1 = [
                    'name' => $uploads[0]->file_name,
                    'path' => $uploads[0]->getFullUrl()
                ];
                $user->file_2 = [
                    'name' => $uploads[1]->file_name,
                    'path' => $uploads[1]->getFullUrl()
                ];
                $user->file_3 = [
                    'name' => $uploads[2]->file_name,
                    'path' => $uploads[2]->getFullUrl()
                ];
            }

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function activate(User $user)
    {
        $user->active = true;

        $user->save();

        return response(['data' => $user, 'message' => 'Account enabled']);
    }

    public function deactivate(User $user)
    {
        $user->active = false;

        $user->save();

        return response(['data' => $user, 'message' => 'Account disabled']);
    }
}
