<?php
namespace App\Models;
use CodeIgniter\Model;

class ClubModel extends Model {
    protected $table         = 'clubs';
    protected $allowedFields = ['name', 'slug', 'description', 'logo_url', 'banner_url', 'is_active'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    public function findBySlug(string $slug) {
        return $this->where('slug', $slug)->where('is_active', true)->first();
    }
}