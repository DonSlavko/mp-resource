<?php

namespace App\Http\Controllers\Backend;

use App\CallService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CallServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attribute = CallService::all()->toArray();

        return response(['data' => $attribute]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            CallService::create($data);

            return response(['Message successfully sent to service']);
        } catch (\Exception $exception) {
            return response(['message' => 'There was an error. Please try again later'], 500);
        }
    }
}
