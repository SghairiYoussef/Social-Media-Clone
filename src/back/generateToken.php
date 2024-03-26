<?php
function generateToken($length = 32) {
    // Generate random bytes
    $randomBytes = random_bytes($length / 2);

    // Convert random bytes to hexadecimal string
    $token = bin2hex($randomBytes);

    return $token;
}

