<?php

namespace App\Policies;

use App\Models\AdminUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegistrationCompletedPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
