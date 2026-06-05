<?php

// Connection configuration: prefer environment variables for Supabase.
// You can set these in your server environment. Example (PowerShell):
// $env:SUPABASE_URL='https://<project>.supabase.co'
// $env:SUPABASE_DB_HOST='db.<project>.supabase.co' (optional)
// $env:SUPABASE_PORT='5432'
// $env:SUPABASE_DB='postgres'
// $env:SUPABASE_USER='postgres'
// $env:SUPABASE_PASS='<your-db-password-or-service-role-key>'

$supabaseUrl = getenv('SUPABASE_URL') ?: '';
$host = getenv('SUPABASE_DB_HOST') ?: '';
$port = getenv('SUPABASE_PORT') ?: '5432';
$db   = getenv('SUPABASE_DB') ?: 'postgres';
$user = getenv('SUPABASE_USER') ?: 'postgres';
$pass = getenv('SUPABASE_PASS') ?: '';

// If DB host isn't provided, try to derive it from SUPABASE_URL (prefix with db.)
if (empty($host) && !empty($supabaseUrl)) {
    $parts = parse_url($supabaseUrl);
    if (isset($parts['host'])) {
        $hostCandidate = $parts['host'];
        if (stripos($hostCandidate, 'db.') === 0) {
            $host = $hostCandidate;
        } else {
            $host = 'db.' . $hostCandidate;
        }
    }
}

if (empty($host)) {
    // Fallback to localhost for local dev if nothing is set
    $host = 'localhost';
}

// Use PDO with the pgsql driver for Supabase / PostgreSQL. Enforce SSL.
$dsn = "pgsql:host={$host};port={$port};dbname={$db};sslmode=require";
try {
    $conn = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}