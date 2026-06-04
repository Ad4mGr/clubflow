<?php
namespace App\Controllers;

use App\Models\ClubModel;
use App\Models\MembershipModel;
use CodeIgniter\RESTful\ResourceController;

class ClubController extends ResourceController {
    protected $format = 'json';

    // GET /api/clubs
    public function index() {
        $model = new ClubModel();
        return $this->respond($model->where('is_active', true)->findAll());
    }

    // GET /api/clubs/:slug
    public function show($slug = null) {
        $club = (new ClubModel())->findBySlug($slug);
        if (!$club) return $this->failNotFound('Club not found');

        $members = (new MembershipModel())->getClubMembers($club['id']);
        return $this->respond([...$club, 'members' => $members]);
    }

    // POST /api/clubs  (admin only — add a platform-level admin role later)
    public function create() {
        $rules = [
            'name'        => 'required|min_length[3]|is_unique[clubs.name]',
            'description' => 'permit_empty',
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors(), 422);

        $name = $this->request->getVar('name');
        $slug = url_title($name, '-', true);

        $model = new ClubModel();
        $id    = $model->insert([
            'name'        => $name,
            'slug'        => $slug,
            'description' => $this->request->getVar('description'),
        ]);

        return $this->respondCreated($model->find($id));
    }
}