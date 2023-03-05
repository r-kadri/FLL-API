<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Learner extends Model
{
    use HasFactory;

    /**
     * Get the user account associated with the learner
     */
    public function user(): HasOne {
        return $this->hasOne(User::class);
    }
}
