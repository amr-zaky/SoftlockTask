<?php

return [
    'default' => env('AEC_Algo', 'aec'),

    'aec' => [
        'class' =>App\Http\Controllers\SecurityAlgorithms\AECAlgo::class,
    ],

   
];