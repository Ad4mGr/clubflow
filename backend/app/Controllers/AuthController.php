<?php

namespace App\Controllers;

use App\Services\AuthUser;
use Firebase\JWT\JWT;

class AuthController extends BaseController
{
    private function issueToken(int $userId): string
    {
        $secret = env('JWT_SECRET');
        $ttl    = (int) (env('JWT_TTL') ?: 3600);
        $now    = time();

        $payload = [
            'uid' => $userId,
            'iat' => $now,
            'exp' => $now + $ttl,
        ];

        return JWT::encode($payload, $secret, 'HS256');
    }

    public function signup()
    {
        $data = $this->request->getJSON(true) ?? $this->request->getPost();

        $fullName = trim($data['full_name'] ?? '');
        $email    = strtolower(trim($data['email'] ?? ''));
        $password = $data['password'] ?? '';

        if ($fullName === '' || $email === '' || $password === '') {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'full_name, email, and password are required',
            ]);
        }

        $db      = db_connect();
        $builder = $db->table('users');

        $exists = $builder->where('email', $email)->get()->getRowArray();
        if ($exists) {
            return $this->response->setStatusCode(409)->setJSON([
                'error' => 'Email already registered',
            ]);
        }

        $builder->insert([
            'full_name'  => $fullName,
            'email'      => $email,
            'password'   => password_hash($password, PASSWORD_BCRYPT),
            'student_id' => null,
            'avatar_url' => null,
            'created_at' => date('c'),
        ]);

        $userId = (int) $db->insertID();
        $user   = $builder->where('id', $userId)->get()->getRowArray();

        $token = $this->issueToken($userId);

        return $this->response->setJSON([
            'token' => $token,
            'user'  => $user,
        ]);
    }

    public function login()
    {
        $data = $this->request->getJSON(true) ?? $this->request->getPost();

        $email    = strtolower(trim($data['email'] ?? ''));
        $password = $data['password'] ?? '';

        if ($email === '' || $password === '') {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'email and password are required',
            ]);
        }

        $db      = db_connect();
        $builder = $db->table('users');

        $user = $builder->where('email', $email)->get()->getRowArray();
        if (!$user || !password_verify($password, $user['password'])) {
            return $this->response->setStatusCode(401)->setJSON([
                'error' => 'Invalid credentials',
            ]);
        }

        $token = $this->issueToken((int) $user['id']);

        return $this->response->setJSON([
            'token' => $token,
            'user'  => $user,
        ]);
    }

    public function me()
    {
        $userId = AuthUser::id();
        if (!$userId) {
            return $this->response->setStatusCode(401)->setJSON([
                'error' => 'Unauthorized',
            ]);
        }

        $db      = db_connect();
        $builder = $db->table('users');

        $user = $builder->where('id', $userId)->get()->getRowArray();

        return $this->response->setJSON([
            'user' => $user,
        ]);
    }
}