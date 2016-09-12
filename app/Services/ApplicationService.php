<?php
/**
 * Created by PhpStorm.
 * User: richjones
 * Date: 9/11/16
 * Time: 1:05 PM
 */

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
     * Model's collection of data
     * @var
     */
    protected $collection;

    /**
     * ApplicationService constructor.
     * @param ApplicationRepository $repo
     */
    public function __construct(ApplicationRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * - set class for model.
     * - get model's collection of data.
     * - return displayable array.
     *
     * @param $appModel
     * @return array
     */
    public function getFirstDisplayable($appModel)
    {
        //set the model.
        $this->repo->setModel($appModel);

        // get the data collection
        $this->collection =  $this->repo->find(1);

        // only return the model's displayable fields.
        return $this->displayOnlyFillableFields();
    }

}