<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class StudentFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $user = session()->get('user');
        $allowedRoles = ['student','admin'];

        // If not logged in or not a student, redirect to login
       if (! isset($user['role_name']) || ! in_array($user['role_name'], $allowedRoles)) {
          

            return response()
            ->setStatusCode(403)
            ->setBody(view('errors/html/error_403'));


        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
