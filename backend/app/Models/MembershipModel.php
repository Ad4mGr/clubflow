<?php
namespace App\Models;
use CodeIgniter\Model;

class MembershipModel extends Model {
    protected $table         = 'club_memberships';
    protected $allowedFields = ['user_id', 'club_id', 'role', 'status'];
    protected $useTimestamps = true;
    protected $createdField  = 'joined_at';
    protected $updatedField  = '';

    // Get all active members of a club with user info
    public function getClubMembers(int $clubId): array {
        return $this->db->table('club_memberships m')
            ->select('u.id, u.full_name, u.email, u.avatar_url, m.role, m.status, m.joined_at')
            ->join('users u', 'u.id = m.user_id')
            ->where('m.club_id', $clubId)
            ->where('m.status', 'active')
            ->orderBy('CASE m.role WHEN \'president\' THEN 1 WHEN \'officer\' THEN 2 ELSE 3 END')
            ->get()->getResultArray();
    }

    // Get all clubs a user belongs to
    public function getUserClubs(int $userId): array {
        return $this->db->table('club_memberships m')
            ->select('c.id, c.name, c.slug, c.logo_url, m.role, m.status')
            ->join('clubs c', 'c.id = m.club_id')
            ->where('m.user_id', $userId)
            ->where('m.status', 'active')
            ->get()->getResultArray();
    }

    public function getMembership(int $userId, int $clubId): array|null {
        return $this->where('user_id', $userId)->where('club_id', $clubId)->first();
    }
}