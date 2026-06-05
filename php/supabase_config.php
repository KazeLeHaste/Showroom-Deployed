<?php
// Supabase REST helper - use environment variables for credentials
// Do NOT commit secrets. Set SUPABASE_URL and SUPABASE_KEY in your server environment.

function supabase_request($method, $table, $data = null, $filters = '') {
    $base = rtrim(getenv('SUPABASE_URL') ?: '', '/');
    $key = getenv('SUPABASE_KEY') ?: '';

    if (empty($base) || empty($key)) {
        throw new RuntimeException('SUPABASE_URL or SUPABASE_KEY environment variable not set.');
    }

    $url = $base . '/rest/v1/' . $table . $filters;

    $headers = [
        'Content-Type: application/json',
        'apikey: ' . $key,
        'Authorization: Bearer ' . $key,
        'Prefer: return=representation'
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));

    if ($data !== null) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err = curl_error($ch);
    curl_close($ch);

    if ($err) {
        return ['error' => $err, 'status' => $httpCode];
    }

    $decoded = json_decode($response, true);
    return ['status' => $httpCode, 'data' => $decoded, 'raw' => $response];
}

// Convenience wrappers
function sb_get($table, $filters = '?select=*') {
    return supabase_request('GET', $table, null, $filters);
}

function sb_insert($table, $payload) {
    return supabase_request('POST', $table, $payload, '');
}

function sb_update($table, $payload, $filters) {
    // $filters example: "?id=eq.123" or "?user_id=eq.5"
    return supabase_request('PATCH', $table, $payload, $filters);
}

function sb_delete($table, $filters) {
    return supabase_request('DELETE', $table, null, $filters);
}

// Usage note (example): set environment variables and call these helpers from your PHP code.
// PowerShell example to set for current session:
// $env:SUPABASE_URL = 'https://your-project-ref.supabase.co'
// $env:SUPABASE_KEY = 'your-anon-or-service-role-key'

?>