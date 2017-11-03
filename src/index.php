<?php
namespace App;

require_once "/app/vendor/autoload.php";

use GuzzleHttp\Client;

$date = (new \DateTime())->setTime(0, 0, 0);
$today = $date->format('Y-m-d') . 'T' . $date->format('H:i:s');

$base_uri = "http://10.0.8.30:8080";

$client = new Client([
    'base_uri' => $base_uri,
    'auth' => ['Администратор', '4886'],
    'timeout' => 5
]);

$response = $client->request(
    'GET',
    "/lpp_ktk/odata/standard.odata/InformationRegister_МенюСтоловых_RecordType/SliceFirst(Period=datetime'". $today ."')",
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

foreach($menues as $kompleks) {
    if ($kompleks->Period !== $today) continue;

    if ($kompleks->Столовая == "КАЗКА") {
        $skazka[$kompleks->Комплекс][] = [
            'name' => $kompleks->Блюдо,
            'amount' => $kompleks->Выход,
            'price' => $kompleks->Сумма
        ];
    } else {
        $pripyat[$kompleks->Комплекс][] = [
            'name' => $kompleks->Блюдо,
            'amount' => $kompleks->Выход,
            'price' => $kompleks->Сумма
        ];
    }
}

include('view.php');
