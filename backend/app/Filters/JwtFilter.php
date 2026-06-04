<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Services\AuthUser;
class JwtFilter implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null) {
        $header = $request->getHeaderLine('Authorization');

        if (!$header || !str_starts_with($header, 'Bearer ')) {
            return service('response')->setStatusCode(401)->setJSON(['error' => 'Token required']);
        }

        try {
            $token   = substr($header, 7);
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            AuthUser::set($decoded->uid);
        } catch (\Exception $e) {
            return service('response')->setStatusCode(401)->setJSON(['error' => 'Invalid or expired token']);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}