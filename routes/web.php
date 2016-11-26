<?php

use App\Enum\EnumAppTypes;

Route::get('map', function() {
    $myArray = [1,2,3];
//    $myArray = [
//        'bob' => 1,
//        'john' => 2,
//        'steve' => 3,
//    ];

    echo "starting with ";
    var_dump($myArray);


    $myResult = array_map(function($value) {
        return $value * 2;
    }, $myArray);

    echo "ending with ";
    var_dump($myResult);
});

Route::get('reduce', function() {
    $myArray = [1,2,3];
//    $myArray = [
//        'bob' => 1,
//        'john' => 2,
//        'steve' => 3,
//    ];

    echo "starting with: " . json_encode($myArray) . "<br/><br/>";

    $myResult = array_reduce($myArray, function($carry, $item) {
        return $carry += $item ?: $carry;
    });

    echo "ending with: " . json_encode($myResult) . "<br/><br/>";
});

Route::get('decorator', 'Decorator@show');

Route::get('/', function () {
//    return view('welcome');
//    return view('testing');
    return view('testing02');

//    $types = new EnumAppTypes();
//
//    var_dump($types->getConstantsList());
//    var_dump($types->displayArrayFormat());
//
//class bob {
//
//    private $appTypeEnums;
//
//    public function __construct(EnumAppTypes $appTypes)
//    {
//        $this->appTypeEnums = $appTypes;
//    }
//
//    public function getEnums()
//    {
//        return $this->appTypeEnums;
//    }
//}
//
//$myBob = new bob(new EnumAppTypes());
//
//var_dump($myBob->getEnums()->getName(EnumAppTypes::MAIN));
//var_dump($myBob->getEnums()->getName(EnumAppTypes::JOINT));
//
////    foreach($types as $key => $value)
////    {
////        echo "type is: $key" . '<br/>';
////    }
});//

Route::get('/test', ['as' => 'bar.show', 'uses' => 'BarController@show']);


Route::get('/phpfiddler', 'PhpFiddler@show');