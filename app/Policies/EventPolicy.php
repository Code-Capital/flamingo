<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool
    {
        // Assuming you have a method to get remaining events in the User model
        $remainingEvents = $user->getRemainingEvents();

        // Allow the user to create an event if they have remaining events available
        return $remainingEvents > 0;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Assuming you have a method to get remaining events in the User model
        $remainingEvents = $user->getRemainingEvents();

        // Allow the user to create an event if they have remaining events available
        return $remainingEvents > 0;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Event $event): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Event $event): bool
    {
        //
    }


    public function canjoin(User $user, Event $event): bool
    {
        // Assuming you have a method to get remaining events in the User model
        $count = $user->getRemainingEventsJoinings();

        // Allow the user to create an event if they have remaining events available
        return $count > 0;
    }
}
