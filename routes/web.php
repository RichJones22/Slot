<?php

use App\Enum\EnumAppTypes;

Route::get('/', function () {
//    return view('welcome');
//    return view('testing');
//    return view('testing02');

    $types = new EnumAppTypes();

    var_dump($types->getConstantsList());
    var_dump($types->displayArrayFormat());

class bob {

    private $appTypeEnums;

    public function __construct(EnumAppTypes $appTypes)
    {
        $this->appTypeEnums = $appTypes;
    }

    public function getEnums()
    {
        return $this->appTypeEnums;
    }
}

$myBob = new bob(new EnumAppTypes());

var_dump($myBob->getEnums()->getName(EnumAppTypes::MAIN));
var_dump($myBob->getEnums()->getName(EnumAppTypes::JOINT));

//    foreach($types as $key => $value)
//    {
//        echo "type is: $key" . '<br/>';
//    }
});

Route::get('/test', ['as' => 'bar.show', 'uses' => 'BarController@show']);
