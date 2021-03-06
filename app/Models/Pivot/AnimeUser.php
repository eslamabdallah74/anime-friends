<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AnimeUser extends Pivot
{

    public static $status = [
        'WANT_TO_WATCH' => 'Want to watch',
        'WATCHING'      => 'Watching',
        'WATCHED'       => 'Watched',
    ];

    public function getActionAttribute()
    {
        return match($this->status) {
            'WANT_TO_WATCH' => 'Wants to watch',
            'WATCHING'      => 'Is watching',
            'WATCHED'       => 'Has finished',
        };
    }
}
