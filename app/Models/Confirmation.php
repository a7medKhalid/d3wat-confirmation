<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Confirmation extends Model
{
    public const MODE_DIRECT = 'direct';

    public const MODE_SESSION = 'session';

    protected $fillable = [
        'confirmation_session_id',
        'phone',
        'name',
        'visitor_key',
        'mode',
        'confirmed_at',
        'ip_address',
    ];

    protected function casts(): array
    {
        return [
            'confirmed_at' => 'datetime',
        ];
    }

    public function confirmationSession(): BelongsTo
    {
        return $this->belongsTo(ConfirmationSession::class);
    }
}
