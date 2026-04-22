<?php

// app/Controllers/Admin/TeacherManagementController.php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

/**
 * TeacherManagementController
 *
 * Lists all teacher accounts for Administrators and Coordinators.
 */
class TeacherManagementController extends BaseController
{
    protected UserModel $userModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->userModel = new UserModel();

        // Access Control: Admins and Coordinators only
        $role = session('user')['role_name'] ?? '';
        if (! in_array($role, ['admin', 'coordinator'])) {
            header('Location: ' . base_url('/dashboard'));
            exit();
        }
    }

    /**
     * List all users whose role is 'teacher'.
     */
    public function index()
    {
        $teachers = $this->userModel->db->table('users u')
            ->select('u.id, u.name, u.email, u.created_at, u.profile_image')
            ->join('roles r', 'r.id = u.role_id', 'left')
            ->where('r.name', 'teacher')
            ->where('u.deleted_at IS NULL')
            ->orderBy('u.name', 'ASC')
            ->get()->getResultArray();

        return view('admin/teachers/index', ['teachers' => $teachers]);
    }

    /**
     * Show a detailed profile for a teacher.
     */
    public function show(int $id)
    {
        $teacher = $this->userModel->findWithRole($id);

        if (! $teacher || $teacher['role_name'] !== 'teacher') {
            session()->setFlashdata('error', 'Teacher record not found.');
            return redirect()->to('/admin/teachers');
        }

        return view('admin/teachers/show', ['teacher' => $teacher]);
    }
}
