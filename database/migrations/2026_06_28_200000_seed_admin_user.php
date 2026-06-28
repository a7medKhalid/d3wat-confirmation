<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    private const ADMIN_EMAIL = 'admin@d3wat.test';

    private const ADMIN_NAME = 'Admin';

    private const ADMIN_PASSWORD = 'password';

    public function up(): void
    {
        User::query()->updateOrCreate(
            ['email' => self::ADMIN_EMAIL],
            [
                'name' => self::ADMIN_NAME,
                'password' => self::ADMIN_PASSWORD,
            ],
        );
    }

    public function down(): void
    {
        User::query()->where('email', self::ADMIN_EMAIL)->delete();
    }
};
