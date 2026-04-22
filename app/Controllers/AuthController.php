<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected UserModel $userModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->userModel = new UserModel();
    }

    /**
     * Show Login Form
     */
    public function index()
    {
        // If already logged in, go to dashboard
        if (session()->has('user')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    /**
     * Process Login
     */
    public function authenticate()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        


        // 1. Find user by email
        $user = $this->userModel->findByEmail($email);

        if (! $user) {
            session()->setFlashdata('error', 'Invalid email or password.');
            return redirect()->back()->withInput();
        }

        // 2. Verify Password
        // Note: In production, use password_hash() and password_verify().
        // For this activity, we are checking plain text for simplicity, 
        // but typically it should be: if (! password_verify($password, $user['password']))
        if (!password_verify($password,$user['password'])) {
            session()->setFlashdata('error', 'Invalid email or password.');
            return redirect()->back()->withInput();
        }

        // 3. IMPORTANT: Get user data WITH role name
        $userData = $this->userModel->findWithRole($user['id']);

        // 4. Save to session
        session()->set('user', $userData);

        session()->setFlashdata('success', 'Logged in successfully! Welcome, ' . esc($userData['name']));
        return redirect()->to('/dashboard');
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
