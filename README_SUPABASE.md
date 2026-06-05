Supabase + PHP — Environment Variables and Quick Setup
=====================================================

This project uses a PostgreSQL database hosted on Supabase. The PHP code expects database credentials to be provided via environment variables. Do NOT commit secrets to the repository.

Required environment variables
- SUPABASE_URL — your Supabase project URL, e.g. https://<project-ref>.supabase.co
- SUPABASE_DB_HOST — (optional) the database host, e.g. db.<project-ref>.supabase.co; if not set it will be derived from SUPABASE_URL
- SUPABASE_PORT — (optional) database port (default: 5432)
- SUPABASE_DB — (optional) database name (default: postgres)
- SUPABASE_USER — database user (default: postgres)
- SUPABASE_PASS — database password or service-role key (keep secret)

Optional for REST helper
- SUPABASE_KEY — anon or service role key for REST API access (if you plan to use php/supabase_config.php)

Where to set them
- On Windows (PowerShell), for the current session:
  ```powershell
  $env:SUPABASE_URL = 'https://jegedscefxrlhagveflq.supabase.co'
  $env:SUPABASE_DB_HOST = 'db.jegedscefxrlhagveflq.supabase.co'
  $env:SUPABASE_PORT = '5432'
  $env:SUPABASE_DB = 'postgres'
  $env:SUPABASE_USER = 'postgres'
  $env:SUPABASE_PASS = 'your-db-password'
  $env:SUPABASE_KEY = 'your-supabase-anon-or-service-role-key'  # optional
  ```

- On Linux / macOS (bash), for the current session:
  ```bash
  export SUPABASE_URL='https://jegedscefxrlhagveflq.supabase.co'
  export SUPABASE_DB_HOST='db.jegedscefxrlhagveflq.supabase.co'
  export SUPABASE_PORT='5432'
  export SUPABASE_DB='postgres'
  export SUPABASE_USER='postgres'
  export SUPABASE_PASS='your-db-password'
  export SUPABASE_KEY='your-supabase-anon-or-service-role-key'  # optional
  ```

Persistent configuration
- For persistent deployment, set these as environment variables in your web host, container, or system service configuration (e.g., Apache, systemd, Docker, or your cloud provider's secret manager).

PHP requirements
- Enable PDO and the pgsql driver (`pdo_pgsql`) in your `php.ini` and restart your web server.

Files using these variables
- `php/connect.php` — connects to PostgreSQL using PDO. It prefers `SUPABASE_DB_HOST` and will derive a host from `SUPABASE_URL` if necessary.
- `php/supabase_config.php` — optional REST helper that uses `SUPABASE_URL` and `SUPABASE_KEY`.

Security notes
- Never store credentials in source control. Use environment variables or a secret manager.
- Use the anon/public key for browser-side REST requests only when RLS policies are configured. Use the service-role key only on the server and keep it secret.

Testing
- After setting env vars and enabling `pdo_pgsql`, test a simple page (e.g., open the app and try signup/login) and monitor PHP errors if anything fails.

If you want, I can add a small `env.example` file or a `.env` loader (phpdotenv) to make local development easier.
