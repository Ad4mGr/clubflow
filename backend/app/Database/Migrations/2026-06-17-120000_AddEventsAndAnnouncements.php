<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEventsAndAnnouncements extends Migration
{
    public function up() {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'club_id'     => ['type' => 'INT'],
            'title'       => ['type' => 'VARCHAR', 'constraint' => 255],
            'description' => ['type' => 'TEXT', 'null' => true],
            'location'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'start_time'  => ['type' => 'TIMESTAMPTZ'],
            'end_time'    => ['type' => 'TIMESTAMPTZ', 'null' => true],
            'created_by'  => ['type' => 'INT'],
            'created_at'  => ['type' => 'TIMESTAMPTZ', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('club_id', 'clubs', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('events');
        $this->db->query('CREATE INDEX idx_events_club ON events(club_id)');

        $this->forge->addField([
            'id'        => ['type' => 'INT', 'auto_increment' => true],
            'event_id'  => ['type' => 'INT'],
            'user_id'   => ['type' => 'INT'],
            'status'    => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'going'],
            'created_at' => ['type' => 'TIMESTAMPTZ', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('event_id', 'events', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addUniqueKey(['event_id', 'user_id']);
        $this->forge->createTable('event_rsvps');
        $this->db->query('CREATE INDEX idx_rsvps_event ON event_rsvps(event_id)');

        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true],
            'club_id'    => ['type' => 'INT'],
            'title'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'body'       => ['type' => 'TEXT'],
            'created_by' => ['type' => 'INT'],
            'created_at' => ['type' => 'TIMESTAMPTZ', 'null' => true],
            'updated_at' => ['type' => 'TIMESTAMPTZ', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('club_id', 'clubs', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('announcements');
        $this->db->query('CREATE INDEX idx_announcements_club ON announcements(club_id)');
    }

    public function down() {
        $this->forge->dropTable('event_rsvps', true);
        $this->forge->dropTable('events', true);
        $this->forge->dropTable('announcements', true);
    }
}
