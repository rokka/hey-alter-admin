<?php

namespace App\Providers\src;

use App\Interfaces\UpdatesTeam;

class Jetstream extends \Laravel\Jetstream\Jetstream
{

    /**
     * Register a class / callback that should be used to update team names.
     *
     * @param  string  $class
     * @return void
     */
    public static function updateTeamUsing(string $class)
    {
        return app()->singleton(UpdatesTeam::class, $class);
    }

    /**
     * Register a class / callback that should be used to add team members.
     *
     * @param  string  $class
     * @return void
     */

}
