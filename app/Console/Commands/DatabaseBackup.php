<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Carbon\Carbon;

class DatabaseBackup extends Command
{
    protected $signature = 'db:backup {--driver=} {--path=}';
    protected $description = 'Create a database backup for sqlite/mysql/pgsql';

    public function handle(): int
    {
        $driver = $this->option('driver') ?: Config::get('database.default');
        $timestamp = Carbon::now()->format('Ymd_His');
        $path = $this->option('path') ?: storage_path('app/backups');

        if (! is_dir($path)) {
            mkdir($path, 0775, true);
        }

        try {
            switch ($driver) {
                case 'sqlite':
                    $dbPath = Config::get('database.connections.sqlite.database');
                    if (! $dbPath || ! file_exists($dbPath)) {
                        $this->error('SQLite database file not found: ' . $dbPath);
                        return self::FAILURE;
                    }
                    $dest = $path . DIRECTORY_SEPARATOR . 'sqlite_backup_' . $timestamp . '.db';
                    copy($dbPath, $dest);
                    $this->info('SQLite backup created: ' . $dest);
                    break;

                case 'mysql':
                    $host = Config::get('database.connections.mysql.host');
                    $port = Config::get('database.connections.mysql.port');
                    $user = Config::get('database.connections.mysql.username');
                    $pass = Config::get('database.connections.mysql.password');
                    $name = Config::get('database.connections.mysql.database');
                    $out = $path . DIRECTORY_SEPARATOR . 'mysql_' . $name . '_' . $timestamp . '.sql';
                    $cmd = [
                        'mysqldump', '-h', $host, '-P', (string)$port, '-u', $user, '-p' . $pass, $name
                    ];
                    $process = new Process($cmd);
                    $process->run();
                    if (! $process->isSuccessful()) {
                        $this->error('mysqldump failed: ' . $process->getErrorOutput());
                        return self::FAILURE;
                    }
                    file_put_contents($out, $process->getOutput());
                    $this->info('MySQL backup created: ' . $out);
                    break;

                case 'pgsql':
                    $host = Config::get('database.connections.pgsql.host');
                    $port = Config::get('database.connections.pgsql.port');
                    $user = Config::get('database.connections.pgsql.username');
                    $pass = Config::get('database.connections.pgsql.password');
                    $name = Config::get('database.connections.pgsql.database');
                    $out = $path . DIRECTORY_SEPARATOR . 'postgres_' . $name . '_' . $timestamp . '.sql';

                    $env = ['PGPASSWORD' => (string)$pass] + $_ENV + $_SERVER;
                    $cmd = ['pg_dump', '-h', $host, '-p', (string)$port, '-U', $user, $name];
                    $process = new Process($cmd, null, $env);
                    $process->run();
                    if (! $process->isSuccessful()) {
                        $this->error('pg_dump failed: ' . $process->getErrorOutput());
                        return self::FAILURE;
                    }
                    file_put_contents($out, $process->getOutput());
                    $this->info('Postgres backup created: ' . $out);
                    break;

                default:
                    $this->error('Unsupported driver: ' . $driver);
                    return self::FAILURE;
            }

            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('Backup error: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}
