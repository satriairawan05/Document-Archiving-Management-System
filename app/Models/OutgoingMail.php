<?php

namespace App\Models;

use App\Models\LetterType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected $with = ['letterType'];

    /**
     * Relaionship to LetterType from Outgoing Mail.
     *
     * @return BelongsTo
     */
    public function letterType(): BelongsTo
    {
        return $this->belonngsTo(LetterType::class);
    }
}
