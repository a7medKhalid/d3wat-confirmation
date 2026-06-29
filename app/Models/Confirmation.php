<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Confirmation extends Model
{
    public const MODE_DIRECT = 'direct';

    public const MODE_SESSION = 'session';

    public const STATUS_VISITED = 'visited';

    public const STATUS_CONFIRMED = 'confirmed';

    public const STATUS_DECLINED = 'declined';

    protected $fillable = [
        'confirmation_session_id',
        'phone',
        'name',
        'visitor_key',
        'mode',
        'status',
        'visited_at',
        'responded_at',
        'confirmed_at',
        'ip_address',
    ];

    protected function casts(): array
    {
        return [
            'visited_at' => 'datetime',
            'responded_at' => 'datetime',
            'confirmed_at' => 'datetime',
        ];
    }

    public function confirmationSession(): BelongsTo
    {
        return $this->belongsTo(ConfirmationSession::class);
    }

    public function hasResponded(): bool
    {
        return in_array($this->status, [self::STATUS_CONFIRMED, self::STATUS_DECLINED], true);
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_CONFIRMED => 'تأكيد حضور',
            self::STATUS_DECLINED => 'اعتذار',
            default => 'زيارة فقط',
        };
    }
}
