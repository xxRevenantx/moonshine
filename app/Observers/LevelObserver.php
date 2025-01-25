<?php

namespace App\Observers;

use App\Models\Level;

class LevelObserver
{

    public function creating(Level $level): void
    {
        $level->order = Level::max('order') + 1;
    }


}
