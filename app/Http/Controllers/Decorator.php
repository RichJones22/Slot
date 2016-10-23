<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

/**
 * Interface CarService
 * @package App\Http\Controllers
 */
interface CarService {
    /**
     * @return mixed
     */
    public function getCost();

    /**
     * @return mixed
     */
    public function getDescription();
}

/**
 * Class BasicInspection
 * @package App\Http\Controllers
 */
Class BasicInspection implements CarService {
    /**
     * @return int
     */
    public function getCost()
    {
        return 25;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return "Basic car inspection is: ";
    }
}

/**
 * Class OilChange
 * @package App\Http\Controllers
 */
Class OilChange implements CarService {

    /**
     * @var CarService
     */
    protected $carService;

    /**
     * OilChange constructor.
     * @param $carService
     */
    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    /**
     * @return int
     */
    public function getCost()
    {
        return 29 + $this->carService->getCost();
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return " plus the cost of an Oil change is: ";
    }
}

/**
 * Class TireRotation
 * @package App\Http\Controllers
 */
Class TireRotation implements CarService {

    /**
     * @var CarService
     */
    protected $carService;

    /**
     * OilChange constructor.
     * @param $carService
     */
    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    /**
     * @return int
     */
    public function getCost()
    {
        return 15 + $this->carService->getCost();
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return " plus the cost of a Tire Rotation is: ";
    }
}

/**
 * Class NewWindshieldWiperBlades
 * @package App\Http\Controllers
 */
Class NewWindshieldWiperBlades implements CarService {

    /**
     * @var CarService
     */
    protected $carService;

    /**
     * OilChange constructor.
     * @param $carService
     */
    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    /**
     * @return int
     */
    public function getCost()
    {
        return 30 + $this->carService->getCost();
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return " plus the cost of new Windshield Wiper Blades is: ";
    }
}

/**
 * Class Decorator
 * @package App\Http\Controllers
 */
final class Decorator extends Controller
{
    /***
     * @var array
     */
    protected $didChooseCarServices = [
//        'OilChange',
//        'TireRotation',
//        'NewWindshieldWiperBlades'
    ];

    /**
     * @var BasicInspection
     */
    private $basicCarInspection;

    /**
     * Decorator constructor.
     * @param BasicInspection $basicCarInspection
     */
    public function __construct(BasicInspection $basicCarInspection)
    {
        $this->basicCarInspection = $basicCarInspection;
    }

    /**
     * show method
     */
    public function show()
    {
        /** @var CarService $allServices */
        $allServices=$this->basicCarInspection;
        echo $allServices->getDescription() . $allServices->getCost() . "<br/>";

        foreach ($this->didChooseCarServices as $service)
        {
            $service = __NAMESPACE__ . "\\" . $service;
            $allServices = new $service($allServices);
            echo $allServices->getDescription() . $allServices->getCost() . "<br/>";
        }
    }
}
