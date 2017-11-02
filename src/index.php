<?php
namespace App;

require_once "/app/vendor/autoload.php";

use GuzzleHttp\Client;

$base_uri = "http://10.0.8.30:8080";

$client = new Client([
    'base_uri' => $base_uri,
    'auth' => ['Администратор', '4886'],
    'timeout' => 5
]);

$response = $client->request(
    'GET',
    '/lpp_ktk/odata/standard.odata/InformationRegister_ДневныеМеню',
    [
        'query' => [
            '$format' => 'json',
        ]
    ]
);

$json = json_decode($response->getBody());

$menues = $json->value;

$skazka = [];
$pripyat = [];

foreach($menues as $key => $value) {
    foreach($value->RecordSet as $kompleks) {
        if ($kompleks->Склад == "ВГХ ЇДАЛЬНЯ \"ПРИП'ЯТЬ\"") {
            $pripyat[$kompleks->Комплекс][$kompleks->LineNumber] = [
                'name' => $kompleks->Блюдо,
                'amount' => $kompleks->Выход,
                'price' => $kompleks->Сумма
            ];
        } else {
            $skazka[$kompleks->Комплекс][$kompleks->LineNumber] = [
                'name' => $kompleks->Блюдо,
                'amount' => $kompleks->Выход,
                'price' => $kompleks->Сумма
            ];
        }
    }
}

eval(\Psy\sh());
