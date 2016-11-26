<?php
/**
 * Created by PhpStorm.
 * User: richjones
 * Date: 9/11/16
 * Time: 9:57 AM
 */

namespace App\Repositories;

use Rinvex\Repository\Repositories\EloquentRepository;

/**
 * Class ApplicationRepository
 * @package App\Repositories
 */
class ApplicationRepository extends EloquentRepository
{
    /**
     * @var string
     */
    protected $repositoryId = 'rinvex.repository.uniqueid';

//    public function __construct()
//    {
//        $help = "me";
//    }

}
