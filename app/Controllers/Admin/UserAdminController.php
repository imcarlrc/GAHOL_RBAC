<?php

// app/Controllers/Admin/UserAdminController.php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;

/**
 * UserAdminController  (Admin\UserAdminController)
 *
 * Allows admin to view all users and assign/change their roles.
 * Protected by: auth|admin
 */
class UserAdminController extends BaseController
{
    protected UserModel $userModel;
    protected RoleModel $roleModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();

        // REDUNDANT CHECK: Ensures only admins can proceed
        if (session('user')['role_name'] !== 'admin') {
            header('Location: ' . base_url('/dashboard'));
            exit();
        }
    }

    /**
     * List all users with their current role and a dropdown to change it.
     */
    public function index()
    {
        $allUsers = $this->userModel->getAllWithRoles();

        $staffOnly = array_filter($allUsers,function($user){
            return $user['role_name'] !== 'student';
        });




        $data = [
            'users' => $staffOnly,
            'roles' => $this->roleModel->getDropdown(),  // id => label map for <select>
        ];


        return view('admin/users/index', $data);
    }

   
    public function assignRole(int $userId)
    {
        $user   = $this->userModel->find($userId);
        $roleId = (int) $this->request->getPost('role_id');
        $role   = $this->roleModel->find($roleId);

        if (! $user || ! $role) {
            session()->setFlashdata('error', 'User or role not found.');
            return redirect()->to('/admin/users');
        }

        
        if ($user['id'] === session('user')['id'] && $role['name'] !== 'admin') {
            session()->setFlashdata('error', 'You cannot change your own admin role.');
            return redirect()->to('/admin/users');
        }

        $this->userModel->update($userId, ['role_id' => $roleId]);

        session()->setFlashdata('success',
            esc($user['name']) . ' has been assigned the role: ' . esc($role['label'])
        );
        return redirect()->to('/admin/users');
    }

    public function create(){
        $data['roles'] = $this->roleModel->findAll();
        return view('admin/users/create',$data);
    }

    public function store() {
        // Get role_id from form, or fallback to 'student' if not provided
        $roleId = $this->request->getPost('role_id');
        
        if (!$roleId) {
            $studentRole = $this->roleModel->where('name', 'student')->first();
            $roleId = $studentRole['id'] ?? null;
        }

        $data = [
            'name'       => $this->request->getPost('name'),
            'email'      => $this->request->getPost('email'),
            'password'   => password_hash('Password123', PASSWORD_DEFAULT), // Default Password
            'role_id'    => $roleId,
            'student_id' => $this->request->getPost('student_id'),
        ];

        if (!$this->userModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        return redirect()->to('/admin/users')->with('success', 'User added successfully!');
    }

    public function edit(int $id)
    {
        $user = $this->userModel->find($id);
        
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'User not found.');
        }

        $data = [
            'user'  => $user,
            'roles' => $this->roleModel->findAll(),
        ];

       
        if ($user['role_id'] == 3) {
            return view('admin/users/edit_student', $data);
        }

        return view('admin/users/edit', $data);
    }

    public function update(int $id){
        $data = [
            'name'       => $this->request->getPost('name'),
            'email'      => $this->request->getPost('email'),
            'role_id'    => $this->request->getPost('role_id'),
            'student_id' => $this->request->getPost('student_id'),
            'course'     => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'section'    => $this->request->getPost('section'),
        ];
        $this->userModel->update($id, $data);
        return redirect()->to('/admin/users')->with('success', 'User updated successfully!');
    }

  
    public function createStudent()
    {
        return view('admin/users/create_student');
    }

    
    public function storeStudent()
    {
     
        $studentRole = $this->roleModel->where('name', 'student')->first();
        $roleId = $studentRole['id'] ?? null;

        if (!$roleId) {
            return redirect()->back()->with('error', 'Student role not found in database.');
        }

 
        $data = [
            'name'       => $this->request->getPost('name'),
            'email'      => $this->request->getPost('email'),
            'password'   => password_hash('Student123', PASSWORD_DEFAULT), // Default Secure Password
            'role_id'    => $roleId,
            'student_id' => $this->request->getPost('student_id'),
            'course'     => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'section'    => $this->request->getPost('section'),
        ];

      
        if (!$this->userModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        return redirect()->to('/management/students')->with('success', 'Student enrolled successfully!');
    }

}
