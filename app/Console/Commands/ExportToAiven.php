<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ExportToAiven extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:export-to-aiven {password? : The Aiven MySQL password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer local SQLite data (companies, employees, users) into Aiven MySQL';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $password = $this->argument('password') ?: env('DB_PASSWORD');

        if (empty($password)) {
            $password = $this->secret('Please enter your Aiven MySQL password:');
        }

        // Configure Aiven MySQL connection dynamically
        $host = env('DB_HOST') && env('DB_HOST') !== '127.0.0.1' ? env('DB_HOST') : 'udini17-udini.l.aivencloud.com';
        $port = env('DB_PORT') && env('DB_PORT') !== '3306' ? env('DB_PORT') : '20100';
        $database = env('DB_DATABASE') && env('DB_DATABASE') !== 'laravel' ? env('DB_DATABASE') : 'minicrm';
        $username = env('DB_USERNAME') && env('DB_USERNAME') !== 'root' ? env('DB_USERNAME') : 'avnadmin';

        config([
            'database.connections.mysql.host' => $host,
            'database.connections.mysql.port' => $port,
            'database.connections.mysql.database' => $database,
            'database.connections.mysql.username' => $username,
            'database.connections.mysql.password' => $password,
        ]);

        $this->info("Target: MySQL {$username}@{$host}:{$port}/{$database}");

        // Reconnect to apply new config
        DB::purge('mysql');

        $this->info('1. Running migrations on Aiven MySQL...');
        Artisan::call('migrate', [
            '--database' => 'mysql',
            '--force' => true,
        ]);
        $this->line(Artisan::output());

        $this->info('2. Reading data from local SQLite database...');
        $users = DB::connection('sqlite')->table('users')->get()->map(fn ($r) => (array) $r)->toArray();
        $companies = DB::connection('sqlite')->table('companies')->get()->map(fn ($r) => (array) $r)->toArray();
        $employees = DB::connection('sqlite')->table('employees')->get()->map(fn ($r) => (array) $r)->toArray();

        $this->info('Found in SQLite:');
        $this->line('- Users: '.count($users));
        $this->line('- Companies: '.count($companies));
        $this->line('- Employees: '.count($employees));

        $this->info("3. Transferring records to Aiven ({$database})...");

        // Disable foreign key checks during import
        DB::connection('mysql')->statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing records to avoid duplicates
        DB::connection('mysql')->table('employees')->truncate();
        DB::connection('mysql')->table('companies')->truncate();
        DB::connection('mysql')->table('users')->truncate();

        if (! empty($users)) {
            DB::connection('mysql')->table('users')->insert($users);
        }
        if (! empty($companies)) {
            DB::connection('mysql')->table('companies')->insert($companies);
        }
        if (! empty($employees)) {
            DB::connection('mysql')->table('employees')->insert($employees);
        }

        DB::connection('mysql')->statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info("🎉 Success! All data transferred into Aiven MySQL ({$database})!");

        return Command::SUCCESS;
    }
}
