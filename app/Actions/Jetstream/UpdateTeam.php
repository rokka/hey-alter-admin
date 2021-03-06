<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\UpdatesTeam;

class UpdateTeam implements UpdatesTeam
{
    /**
     * Validate and update the given team's details.
     *
     * @param  mixed  $user
     * @param  mixed  $team
     * @param  array  $input
     * @return void
     */
    public function update($user, $team, array $input)
    {
        Gate::forUser($user)->authorize('update', $team);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'abbreviation' => ['required', 'string', 'max:10'],
            'notfification_stream' => ['string', 'max:255'],
            'notfification_on_computer_created' => [ 'boolean' ],
            'use_donor_information' => [ 'boolean' ],
        ])->validateWithBag('updateTeam');

        $team->forceFill([
            'name' => $input['name'],
            'abbreviation' => $input['abbreviation'],
            'notfification_stream' => $input['notfification_stream'],
            'notfification_on_computer_created' => $input['notfification_on_computer_created'],
            'use_donor_information' => $input['use_donor_information'],
        ])->save();
    }
}
