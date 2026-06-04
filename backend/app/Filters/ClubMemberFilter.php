<?php
namespace App\Filters;

use App\Models\MembershipModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ClubMemberFilter implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null) {
        $clubId = $request->uri->getSegment(3); // /api/clubs/{id}/...
        $userId = $request->jwt_user_id;

        $model      = new MembershipModel();
        $membership = $model->getMembership($userId, $clubId);

        if (!$membership || $membership['status'] !== 'active') {
            return service('response')
                ->setStatusCode(403)
                ->setJSON(['error' => 'Not a member of this club']);
        }

        // Pass membership down to controller
        $request->club_membership = $membership;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}