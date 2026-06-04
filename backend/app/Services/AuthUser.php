<?php
namespace App\Services;

class AuthUser {
    private static ?int $id = null;

    public static function set(int $id): void {
        self::$id = $id;
    }

    public static function id(): ?int {
        return self::$id;
    }
}