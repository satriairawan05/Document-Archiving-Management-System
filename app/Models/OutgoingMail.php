<?php

namespace App\Models;

use App\Models\User;
use App\Models\LetterType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OutgoingMail extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'outgoing_mails';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The relationship for the model.
     *
     * @var string
     */
    protected $with = ['letterType', 'user'];

    /**
     * Relaionship to LetterType from Outgoing Mail.
     *
     * @return BelongsTo
     */
    public function letterType(): BelongsTo
    {
        return $this->belongsTo(LetterType::class, 'letter_id', 'id');
    }

    /**
     * Relationship to User from Outgoing Mail.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
