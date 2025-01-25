<?php

namespace App\Observers;

use App\Models\Supervisor;

class SupervisorObserver
{
    /**
     * Handle the Supervisor "created" event.
     */
    public function creating (Supervisor $supervisor): void
    {
        $supervisor->order = Supervisor::max('order') + 1;
    }
}
