<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ConfirmationSession extends Model
{
    protected $fillable = [
        'uuid',
        'title',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (ConfirmationSession $session): void {
            if (empty($session->uuid)) {
                $session->uuid = (string) Str::uuid();
            }
        });

        static::saved(function (ConfirmationSession $session): void {
            if ($session->is_active) {
                static::query()
                    ->whereKeyNot($session->getKey())
                    ->where('is_active', true)
                    ->update(['is_active' => false]);
            }
        });
    }

    public function confirmations(): HasMany
    {
        return $this->hasMany(Confirmation::class);
    }

    public static function active(): ?self
    {
        return static::query()->where('is_active', true)->first();
    }

    public function getPublicUrlAttribute(): string
    {
        return rtrim(config('app.url'), '/').'/confirm';
    }
}
