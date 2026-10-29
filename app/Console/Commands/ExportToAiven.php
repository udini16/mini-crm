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
    protected $signature = 'app:export-to-aiven';

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

        $this->info('Found:');
        $this->line('- Users: '.count($users));
        $this->line('- Companies: '.count($companies));
        $this->line('- Employees: '.count($employees));

        $this->info('3. Transferring records to Aiven MySQL (minicrm)...');

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

        $this->info('Success! All local data has been transferred into Aiven MySQL minicrm database.');

        return Command::SUCCESS;
    }
}
