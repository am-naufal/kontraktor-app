<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MakeSuperAdmin extends Command
{
    protected $signature = 'make:superadmin
                            {name=Super Admin : Nama user}
                            {email=admin@example.com : Email user}
                            {password=admin123 : Password user}';

    protected $description = 'Buat akun Super Admin untuk login';

    public function handle()
    {
        $user = User::where('email', $this->argument('email'))->first();

        if ($user) {
            $this->error('User dengan email tersebut sudah ada!');
            return;
        }

        $user = User::create([
            'name' => $this->argument('name'),
            'email' => $this->argument('email'),
            'password' => Hash::make($this->argument('password')),
            'role' => 'super_admin',
        ]);

        $this->info("Super Admin berhasil dibuat!");
        $this->info("Email: {$user->email}");
        $this->info("Password: {$this->argument('password')}");
    }
}
