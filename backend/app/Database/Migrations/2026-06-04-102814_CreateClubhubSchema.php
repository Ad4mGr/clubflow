<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClubhubSchema extends Migration
{
    public function up() {
    $this->db->query("CREATE TYPE club_role AS ENUM ('member', 'officer', 'president')");

    $this->forge->addField([
        'id'         => ['type' => 'INT', 'auto_increment' => true],
        'email'      => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
        'password'   => ['type' => 'VARCHAR', 'constraint' => 255],
        'full_name'  => ['type' => 'VARCHAR', 'constraint' => 150],
        'student_id' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
        'avatar_url' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
        'created_at' => ['type' => 'TIMESTAMPTZ', 'null' => true],
    ]);
    $this->forge->addPrimaryKey('id');
    $this->forge->createTable('users');

    $this->forge->addField([
        'id'          => ['type' => 'INT', 'auto_increment' => true],
        'name'        => ['type' => 'VARCHAR', 'constraint' => 150, 'unique' => true],
        'slug'        => ['type' => 'VARCHAR', 'constraint' => 150, 'unique' => true],
        'description' => ['type' => 'TEXT', 'null' => true],
        'logo_url'    => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
        'banner_url'  => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
        'is_active'   => ['type' => 'BOOLEAN', 'default' => true],
        'created_at'  => ['type' => 'TIMESTAMPTZ', 'null' => true],
    ]);
    $this->forge->addPrimaryKey('id');
    $this->forge->createTable('clubs');

    $this->forge->addField([
        'id'        => ['type' => 'INT', 'auto_increment' => true],
        'user_id'   => ['type' => 'INT'],
        'club_id'   => ['type' => 'INT'],
        'role'      => ['type' => 'club_role'],
        'status'    => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'pending'],
        'joined_at' => ['type' => 'TIMESTAMPTZ', 'null' => true],
    ]);
    $this->forge->addPrimaryKey('id');
    $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('club_id', 'clubs', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('club_memberships');

    // indexes
    $this->db->query('CREATE INDEX idx_memberships_club ON club_memberships(club_id)');
    $this->db->query('CREATE INDEX idx_memberships_user ON club_memberships(user_id)');
}

public function down() {
    $this->forge->dropTable('club_memberships', true);
    $this->forge->dropTable('clubs', true);
    $this->forge->dropTable('users', true);
    $this->db->query("DROP TYPE IF EXISTS club_role");
}
}
