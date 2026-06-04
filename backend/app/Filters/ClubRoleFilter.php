<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ClubRoleFilter implements FilterInterface {
    // Usage: filter=role[officer] or filter=role[president]
    public function before(RequestInterface $request, $arguments = null) {
        $membership   = $request->club_membership;
        $requiredRole = $arguments[0] ?? 'officer'; // default: officer+

        $hierarchy = ['member' => 1, 'officer' => 2, 'president' => 3];
        $userLevel = $hierarchy[$membership['role']] ?? 0;
        $reqLevel  = $hierarchy[$requiredRole] ?? 2;

        if ($userLevel < $reqLevel) {
            return service('response')
                ->setStatusCode(403)
                ->setJSON(['error' => "Requires {$requiredRole} role or higher"]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}