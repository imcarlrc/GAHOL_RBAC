<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class TeacherFilter implements FilterInterface
{
    /**
     * This runs BEFORE the controller method.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $user = session()->get('user');

        // ALLOW if the role is 'teacher' OR 'admin'
        $allowedRoles = ['teacher', 'admin'];

        if (! isset($user['role_name']) || ! in_array($user['role_name'], $allowedRoles)) {
          

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