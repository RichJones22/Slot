<?php

namespace App\Http\Controllers;

use App\Services\ApplicationService;
use App\User;

class BarController
{
    public function show(ApplicationService $service)
    {
        // get only displayable first record from the User model.
        $displayFields = $service->getFirstDisplayable(User::class);

        // Find entity by primary key
        dd($displayFields);
    }
}
