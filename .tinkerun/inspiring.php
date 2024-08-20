<?php

use App\Helpers\Helper;
use App\Models\KerangkaAcuan;
$text = '[{"mak":"054.01.WA.2886.EBA.956.051.A.524111","perkiraan":123},{"mak":"054.01.WA.2886.EBA.962.051.A.521211","perkiraan":124}]';
$collection = collect(json_decode($text, true));
$needle ='521211';
$collection->transform(function ($item, $key) {
    return substr($item['mak'],-6);
})->contains(function ($item) use ($needle) {
    return in_array($item, $needle);
} );













