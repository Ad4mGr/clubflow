<?php
namespace App\Controllers;

use App\Services\AuthUser;
use CodeIgniter\RESTful\ResourceController;

class AnnouncementController extends ResourceController {
    protected $format = 'json';
    protected $db;

    public function initController($request, $response, $logger) {
        parent::initController($request, $response, $logger);
        $this->db = db_connect();
    }

    // GET /api/clubs/:clubId/announcements
    public function index($clubId = null) {
        $announcements = $this->db->table('announcements a')
            ->select('a.*, u.full_name as creator_name')
            ->join('users u', 'u.id = a.created_by')
            ->where('a.club_id', $clubId)
            ->orderBy('a.created_at', 'desc')
            ->get()->getResultArray();

        return $this->respond($announcements);
    }

    // GET /api/clubs/:clubId/announcements/:announcementId
    public function show($clubId = null, $announcementId = null) {
        $announcement = $this->db->table('announcements a')
            ->select('a.*, u.full_name as creator_name')
            ->join('users u', 'u.id = a.created_by')
            ->where('a.id', $announcementId)
            ->where('a.club_id', $clubId)
            ->get()->getRowArray();

        if (!$announcement) return $this->failNotFound('Announcement not found');
        return $this->respond($announcement);
    }

    // POST /api/clubs/:clubId/announcements
    public function create($clubId = null) {
        $data = $this->request->getJSON(true) ?? $this->request->getPost();

        $rules = [
            'title' => 'required',
            'body'  => 'required',
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors(), 422);

        $this->db->table('announcements')->insert([
            'club_id'    => $clubId,
            'title'      => $data['title'],
            'body'       => $data['body'],
            'created_by' => AuthUser::id(),
            'created_at' => date('c'),
        ]);

        $id = $this->db->insertID();
        $announcement = $this->db->table('announcements')->where('id', $id)->get()->getRowArray();
        return $this->respondCreated($announcement);
    }

    // PUT /api/clubs/:clubId/announcements/:announcementId
    public function update($clubId = null, $announcementId = null) {
        $existing = $this->db->table('announcements')
            ->where('id', $announcementId)->where('club_id', $clubId)->get()->getRowArray();
        if (!$existing) return $this->failNotFound('Announcement not found');

        $data = $this->request->getJSON(true) ?? $this->request->getPost();

        $update = [];
        if (isset($data['title'])) $update['title'] = $data['title'];
        if (isset($data['body']))  $update['body']  = $data['body'];
        $update['updated_at'] = date('c');

        $this->db->table('announcements')->where('id', $announcementId)->update($update);
        $announcement = $this->db->table('announcements')->where('id', $announcementId)->get()->getRowArray();
        return $this->respond($announcement);
    }

    // DELETE /api/clubs/:clubId/announcements/:announcementId
    public function delete($clubId = null, $announcementId = null) {
        $existing = $this->db->table('announcements')
            ->where('id', $announcementId)->where('club_id', $clubId)->get()->getRowArray();
        if (!$existing) return $this->failNotFound('Announcement not found');

        $this->db->table('announcements')->where('id', $announcementId)->delete();
        return $this->respondDeleted(['message' => 'Announcement deleted']);
    }

}
