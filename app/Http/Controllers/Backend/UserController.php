<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
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

            $user->file_1 = [
                'name' => $uploads[0]->name,
                'path' => $uploads[0]->getFullUrl()
                    . '.' .
                    substr($uploads[0]->mime_type, strpos($uploads[0]->mime_type, "/")+1, strlen($uploads[0]->mime_type))
            ];
            $user->file_2 = [
                'name' => $uploads[1]->name,
                'path' => $uploads[1]->getFullUrl()
                    . '.' .
                    substr($uploads[1]->mime_type, strpos($uploads[1]->mime_type, "/")+1, strlen($uploads[1]->mime_type))
            ];
            $user->file_3 = [
                'name' => $uploads[2]->name,
                'path' => $uploads[2]->getFullUrl()
                    . '.' .
                    substr($uploads[2]->mime_type, strpos($uploads[2]->mime_type, "/")+1, strlen($uploads[2]->mime_type))
            ];

            return $user;
        })->toArray();

        return response(['data' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
