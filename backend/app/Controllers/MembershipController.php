<?php
namespace App\Controllers;

use App\Models\MembershipModel;
use App\Models\ClubModel;
use CodeIgniter\RESTful\ResourceController;
use App\Services\AuthUser;
class MembershipController extends ResourceController {
    protected $format = 'json';

    // POST /api/clubs/:clubId/join
    public function join($clubId = null) {
        $club = (new ClubModel())->find($clubId);
        if (!$club || !$club['is_active']) return $this->failNotFound('Club not found');

        $model      = new MembershipModel();
        $userId     = AuthUser::id();
        $existing   = $model->getMembership($userId, $clubId);

        if ($existing) return $this->fail('Already a member or request pending', 409);

        $model->insert([
            'user_id' => $userId,
            'club_id' => $clubId,
            'role'    => 'member',
            'status'  => 'pending',  // president must approve
        ]);

        return $this->respondCreated(['message' => 'Join request sent']);
    }

    // PATCH /api/clubs/:clubId/members/:userId/approve
    // requires jwt + clubMember + clubRole[officer]
    public function approve($clubId = null, $userId = null) {
        $model      = new MembershipModel();
        $membership = $model->getMembership($userId, $clubId);
        if (!$membership) return $this->failNotFound('Membership not found');

        $model->update($membership['id'], ['status' => 'active']);
        return $this->respond(['message' => 'Member approved']);
    }

    // PATCH /api/clubs/:clubId/members/:userId/role
    // requires jwt + clubMember + clubRole[president]
    public function updateRole($clubId = null, $userId = null) {
        $data   = $this->request->getJSON(true) ?? $this->request->getPost();
        $newRole = $data['role'] ?? '';
        if (!in_array($newRole, ['member', 'officer'])) {
            return $this->fail('Invalid role', 422);
        }

        $model      = new MembershipModel();
        $membership = $model->getMembership($userId, $clubId);
        if (!$membership) return $this->failNotFound();

        $model->update($membership['id'], ['role' => $newRole]);
        return $this->respond(['message' => 'Role updated']);
    }
    // GET /api/me/clubs
    public function myClubs() {
        $userId = AuthUser::id();
        $clubs  = (new MembershipModel())->getUserClubs($userId);
        return $this->respond($clubs);
    }

    // GET /api/clubs/:clubId/members (officer+ — full list with pending)
    public function members($clubId = null) {
        $members = (new MembershipModel())->getAllMembers((int) $clubId);
        return $this->respond($members);
    }
}
