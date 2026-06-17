<?php
namespace App\Controllers;

use App\Services\AuthUser;
use CodeIgniter\RESTful\ResourceController;

class EventController extends ResourceController {
    protected $format = 'json';
    protected $db;

    public function initController($request, $response, $logger) {
        parent::initController($request, $response, $logger);
        $this->db = db_connect();
    }

    // GET /api/clubs/:clubId/events
    public function index($clubId = null) {
        $events = $this->db->table('events')
            ->select('events.*, u.full_name as creator_name')
            ->join('users u', 'u.id = events.created_by')
            ->where('events.club_id', $clubId)
            ->orderBy('events.start_time', 'desc')
            ->get()->getResultArray();

        // Attach RSVP count per event
        foreach ($events as &$event) {
            $event['rsvp_count'] = $this->db->table('event_rsvps')
                ->where('event_id', $event['id'])
                ->where('status', 'going')
                ->countAllResults();

            $event['my_rsvp'] = null;
            $userId = AuthUser::id();
            if ($userId) {
                $rsvp = $this->db->table('event_rsvps')
                    ->where('event_id', $event['id'])
                    ->where('user_id', $userId)
                    ->get()->getRowArray();
                if ($rsvp) $event['my_rsvp'] = $rsvp['status'];
            }
        }

        return $this->respond($events);
    }

    // GET /api/clubs/:clubId/events/:eventId
    public function show($clubId = null, $eventId = null) {
        $event = $this->db->table('events')
            ->select('events.*, u.full_name as creator_name')
            ->join('users u', 'u.id = events.created_by')
            ->where('events.id', $eventId)
            ->where('events.club_id', $clubId)
            ->get()->getRowArray();

        if (!$event) return $this->failNotFound('Event not found');

        $event['attendees'] = $this->db->table('event_rsvps r')
            ->select('u.id, u.full_name, u.email, u.avatar_url, r.status')
            ->join('users u', 'u.id = r.user_id')
            ->where('r.event_id', $eventId)
            ->get()->getResultArray();

        $userId = AuthUser::id();
        $event['my_rsvp'] = null;
        if ($userId) {
            $rsvp = $this->db->table('event_rsvps')
                ->where('event_id', $eventId)
                ->where('user_id', $userId)
                ->get()->getRowArray();
            if ($rsvp) $event['my_rsvp'] = $rsvp['status'];
        }

        return $this->respond($event);
    }

    // POST /api/clubs/:clubId/events
    public function create($clubId = null) {
        $data = $this->request->getJSON(true) ?? $this->request->getPost();

        $rules = [
            'title'      => 'required',
            'start_time' => 'required|valid_date',
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors(), 422);

        $this->db->table('events')->insert([
            'club_id'     => $clubId,
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'location'    => $data['location'] ?? null,
            'start_time'  => $data['start_time'],
            'end_time'    => $data['end_time'] ?? null,
            'created_by'  => AuthUser::id(),
            'created_at'  => date('c'),
        ]);

        $id = $this->db->insertID();
        $event = $this->db->table('events')->where('id', $id)->get()->getRowArray();
        return $this->respondCreated($event);
    }

    // PUT /api/clubs/:clubId/events/:eventId
    public function update($clubId = null, $eventId = null) {
        $existing = $this->db->table('events')
            ->where('id', $eventId)->where('club_id', $clubId)->get()->getRowArray();
        if (!$existing) return $this->failNotFound('Event not found');

        $data = $this->request->getJSON(true) ?? $this->request->getPost();

        $update = [];
        if (isset($data['title']))       $update['title']       = $data['title'];
        if (isset($data['description'])) $update['description'] = $data['description'];
        if (isset($data['location']))    $update['location']    = $data['location'];
        if (isset($data['start_time']))  $update['start_time']  = $data['start_time'];
        if (isset($data['end_time']))    $update['end_time']    = $data['end_time'];

        $this->db->table('events')->where('id', $eventId)->update($update);
        $event = $this->db->table('events')->where('id', $eventId)->get()->getRowArray();
        return $this->respond($event);
    }

    // DELETE /api/clubs/:clubId/events/:eventId
    public function delete($clubId = null, $eventId = null) {
        $existing = $this->db->table('events')
            ->where('id', $eventId)->where('club_id', $clubId)->get()->getRowArray();
        if (!$existing) return $this->failNotFound('Event not found');

        $this->db->table('events')->where('id', $eventId)->delete();
        return $this->respondDeleted(['message' => 'Event deleted']);
    }

    // POST /api/clubs/:clubId/events/:eventId/rsvp
    public function rsvp($clubId = null, $eventId = null) {
        $event = $this->db->table('events')
            ->where('id', $eventId)->where('club_id', $clubId)->get()->getRowArray();
        if (!$event) return $this->failNotFound('Event not found');

        $data   = $this->request->getJSON(true) ?? $this->request->getPost();
        $status = $data['status'] ?? 'going';
        if (!in_array($status, ['going', 'maybe', 'not_going'])) {
            return $this->fail('Invalid RSVP status', 422);
        }

        $userId = AuthUser::id();
        $existing = $this->db->table('event_rsvps')
            ->where('event_id', $eventId)->where('user_id', $userId)
            ->get()->getRowArray();

        if ($existing) {
            $this->db->table('event_rsvps')
                ->where('id', $existing['id'])
                ->update(['status' => $status]);
        } else {
            $this->db->table('event_rsvps')->insert([
                'event_id'   => $eventId,
                'user_id'    => $userId,
                'status'     => $status,
                'created_at' => date('c'),
            ]);
        }

        return $this->respond(['message' => 'RSVP updated', 'status' => $status]);
    }

    // GET /api/clubs/:clubId/events/:eventId/attendees
    public function attendees($clubId = null, $eventId = null) {
        $attendees = $this->db->table('event_rsvps r')
            ->select('u.id, u.full_name, u.email, u.avatar_url, r.status')
            ->join('users u', 'u.id = r.user_id')
            ->where('r.event_id', $eventId)
            ->get()->getResultArray();

        return $this->respond($attendees);
    }

}
