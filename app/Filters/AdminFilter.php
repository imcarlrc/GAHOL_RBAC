<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    /**
     * This runs BEFORE the controller method.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Get the current user from the session
        $user = session()->get('user');

        // 2. Check: Does the user have the 'admin' role?
        // We look for 'role_name' because that's what we joined in UserModel.
        if (! isset($user['role_name']) || $user['role_name'] !== 'admin') {
            return response()
            ->setStatusCode(403)
            ->setBody(view('errors/html/error_403'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // We don't need to do anything after the request.
    }
}
