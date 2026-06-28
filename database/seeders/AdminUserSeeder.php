<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    private const ADMIN_EMAIL = 'admin@d3wat.test';

    private const ADMIN_NAME = 'Admin';

    private const ADMIN_PASSWORD = 'password';

    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => self::ADMIN_EMAIL],
            [
                'name' => self::ADMIN_NAME,
                'password' => self::ADMIN_PASSWORD,
            ],
        );
    }
}
