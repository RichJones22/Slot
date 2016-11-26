<?php

namespace App\Http\Controllers;

use App\Services\ApplicationService;
use App\User;

/**
 * Class BarController.
 */
class BarController extends Controller
{
    /**
     * @param ApplicationService $service
     * @param User $user
     */
    public function show(ApplicationService $service, User $user)
    {
        // get only displayable fields from the User model.
        $displayFields = $service->getDisplayable($user);

        // Find entity by primary key
        dd($displayFields);
    }
}
