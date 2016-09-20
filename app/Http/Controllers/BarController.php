<?php

namespace App\Http\Controllers;

use App\Services\ApplicationService;
use App\User;

class BarController
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show(ApplicationService $service)
    {
        // get only displayable first record from the User model.
        $displayFields = $service->getFirstDisplayable($this->user);

        // Find entity by primary key
        dd($displayFields);
    }
}
