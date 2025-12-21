<?php
namespace App\Utils;

class SessionInitializer {
    public static function init() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}
?>

