<?php

// Connection configuration: prefer environment variables for Supabase.
$host = getenv('SUPABASE_HOST') ?: 'localhost';
$port = getenv('SUPABASE_PORT') ?: '5432';
$db   = getenv('SUPABASE_DB') ?: 'showroom_database';
$user = getenv('SUPABASE_USER') ?: 'root';
$pass = getenv('SUPABASE_PASS') ?: '';

// Use PDO with the pgsql driver for Supabase / PostgreSQL.
$dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";
try {
    $conn = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}