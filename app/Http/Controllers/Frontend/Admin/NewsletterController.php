<?php

namespace App\Http\Controllers\Frontend\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminNewsletter;
use App\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

        $subject = $request->get('subject');
        $users = $request->get('email_list');
        $data = [
            'description' => $request->get('description')
        ];

        Mail::bcc($users)->send(new AdminNewsletter($subject, $data));

        return response(["The Newsletter Is Send To Customers"]);
    }
}
