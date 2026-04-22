<?php

// 1. Base Routes (Publicly Accessible)
$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('dashboard', 'Home::index', ['filter' => 'auth']); // Change this if you have a Dashboard controller
$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::authenticate');
$routes->get('logout', 'AuthController::logout');

// 2. Admin Only Section
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    // Role Management
    $routes->get('roles',                'Admin\RoleController::index');


    //$routes->get('roles/create',         'Admin\RoleController::create');
    //$routes->post('roles/store',          'Admin\RoleController::store');
    //$routes->get('roles/edit/(:num)',    'Admin\RoleController::edit/$1');

    $routes->post('users/assign-role/(:num)', 'Admin\UserAdminController::assignRole/$1');
    $routes->get('roles/delete/(:num)', 'Admin\RoleController::delete/$1');
    $routes->post('roles/update/(:num)',  'Admin\RoleController::update/$1');

    // User Management (Fixed Controller Name)
    $routes->get('users',                'Admin\UserAdminController::index');
    $routes->get('users/create',         'Admin\UserAdminController::create');
    $routes->post('users/store',          'Admin\UserAdminController::store');
    $routes->get('users/edit/(:num)',    'Admin\UserAdminController::edit/$1');
    $routes->post('users/update/(:num)',  'Admin\UserAdminController::update/$1');
    $routes->get('roles/delete/(:num)', 'Admin\RoleController::delete/$1'); 
});

// Faculty Management (Accessible by Admin and Coordinator)
$routes->get('admin/teachers', 'Admin\TeacherManagementController::index', ['filter' => 'auth']);
$routes->get('admin/teachers/show/(:num)', 'Admin\TeacherManagementController::show/$1', ['filter' => 'auth']);
$routes->get('admin/teachers/edit/(:num)', 'Admin\UserAdminController::edit/$1', ['filter' => 'auth']);
$routes->post('admin/teachers/update/(:num)', 'Admin\UserAdminController::update/$1', ['filter' => 'auth']);

// 3. Teacher & Admin Section
    $routes->group('management', ['filter' => 'teacher'], function($routes) {
    $routes->get('students', 'StudentManagementController::index');
    $routes->get('students/edit/(:num)', 'Admin\UserAdminController::edit/$1');
    $routes->post('students/update/(:num)', 'Admin\UserAdminController::update/$1');
    $routes->get('students/create', 'Admin\UserAdminController::createStudent');
    $routes->post('students/store', 'Admin\UserAdminController::storeStudent');

    $routes->get('students/show/(:num)','StudentManagementController::show/$1');
});


$routes->get('teacher-info','Home::index',['filter' => 'teacher']);
$routes->get('student-info','Home::index', ['filter' => 'student']);
$routes->get('admin-info','Home::index', ['filter' => 'admin']);
$routes->get('coordinator-info','Home::index', ['filter' => 'coordinator']);