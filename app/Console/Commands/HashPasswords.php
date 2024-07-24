<?php

namespace App\Console\Commands;

use App\Models\Pendaftar;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class HashPasswords extends Command
{
    /**
     * Execute the console command.
     */
    protected $signature = 'hash:passwords';
    protected $description = 'Hash passwords using bcrypt';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $pendaftars = Pendaftar::all();

        foreach ($pendaftars as $pendaftar) {
            $pendaftar->password = Hash::make($pendaftar->tgl_lahir);
            $pendaftar->save();
        }

        $this->info('All passwords have been hashed.');
    }
}
