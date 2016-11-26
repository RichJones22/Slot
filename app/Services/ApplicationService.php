<?php

namespace App\Services;

use App\Repositories\ApplicationRepository;

/**
 * Class ApplicationService
 * @package App\Services
 */
class ApplicationService extends ApplicationServiceBase
{
    /**
     * @var ApplicationRepository
     */
    protected $repo;

    /**
     * ApplicationService constructor.
     * @param ApplicationRepository $repo
     */
    public function __construct(ApplicationRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param $model
     * @return array
     */
    public function getDisplayable($model)
    {
        //set the model.
        $this->repo->setModel($model);

        // get the data model
        $this->model =  $this->repo->find(1);
        $entity =  collect($this->repo->find(1));
        $entity = $entity->reverse();

        // only return the model's displayable fields.
        return $this->getDisplayOnlyFillableFields();
    }

}