<?php

namespace App\Controllers;

class Home extends BaseController
{
    /**
     * The Dashboard / Home Page
     */
    public function index()
    {
        // 1. Get user from session (This comes from your Login)
        $user = session()->get('user');

        // 2. If not logged in, we let the 'auth' filter handle the redirect,
        // but for now, we'll just show the welcome page if session is empty.
        if (! $user) {
            return view('welcome_message');
        }


        if ($user['role_name'] === 'teacher' || $user['role_name'] === 'admin'){
            return view('teacher/dashboard',['user' => $user]);
        }

        if ($user['role_name'] === 'coordinator') {
            return view('coordinator/dashboard', ['user' => $user]);
        }

        // 3. Show the dashboard based on their role
        // For now, let's load your student dashboard
        return view('student/dashboard', ['user' => $user]);
    }
}
