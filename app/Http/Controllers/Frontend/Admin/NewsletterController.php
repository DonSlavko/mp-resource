<?php

namespace App\Http\Controllers\Frontend\Admin;

use App\Http\Controllers\Controller;
use App\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index() {
        return view('admin.newsletter.index');
    }

    public function list() {
        $newsletter = Newsletter::all();
        return response(['data' => $newsletter]);
    }

    public function SendNewsletterEmail(Request $request) {
        // todo - change to default laravel mailer
        //dd($request->all());
        foreach ($request->EmailList as $list) {
            /*sendMail([
                'view' => 'email.NewsletterEmailFromAdmin',
                'to' => $list,
                'subject' => $request->Subject,
                'data' => [
                    'description' => $request->Description,
                ]
            ]);*/
        }
        return response(['data' => "The Newsletter Is Send To Customer"]);
    }
}
