<?php
namespace App\Controllers;

use App\Models\ClubModel;
use App\Models\MembershipModel;
use App\Services\AuthUser;
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

        $membershipModel = new MembershipModel();
        $members         = $membershipModel->getClubMembers($club['id']);

        $response = [...$club, 'members' => $members];

        // Attach current user's membership if authenticated
        $userId = AuthUser::id();
        if ($userId) {
            $response['my_membership'] = $membershipModel->getMembership($userId, $club['id']);
        }

        return $this->respond($response);
    }

    // POST /api/clubs (authenticated users)
    public function create() {
        $data = $this->request->getJSON(true) ?? $this->request->getPost();

        $rules = [
            'name'        => 'required|min_length[3]|is_unique[clubs.name]',
            'description' => 'permit_empty',
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors(), 422);

        $name = $data['name'];
        $slug = url_title($name, '-', true);

        $model = new ClubModel();
        $id    = $model->insert([
            'name'        => $name,
            'slug'        => $slug,
            'description' => $data['description'] ?? null,
        ]);

        // Creator becomes president automatically
        (new MembershipModel())->insert([
            'user_id' => AuthUser::id(),
            'club_id' => $id,
            'role'    => 'president',
            'status'  => 'active',
        ]);

        return $this->respondCreated($model->find($id));
    }

    // PUT /api/clubs/:id (officer+)
    public function update($id = null) {
        $model = new ClubModel();
        $club  = $model->find($id);
        if (!$club) return $this->failNotFound('Club not found');

        $data = $this->request->getJSON(true) ?? $this->request->getPost();

        $rules = [
            'name' => 'required|min_length[3]|is_unique[clubs.name,id,' . $id . ']',
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors(), 422);

        $updateData = [
            'name' => $data['name'],
            'slug' => url_title($data['name'], '-', true),
        ];
        if (isset($data['description'])) $updateData['description'] = $data['description'];
        if (isset($data['logo_url']))    $updateData['logo_url']    = $data['logo_url'];
        if (isset($data['banner_url']))  $updateData['banner_url']  = $data['banner_url'];

        $model->update($id, $updateData);
        return $this->respond($model->find($id));
    }
}