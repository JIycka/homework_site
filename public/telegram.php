<?php

$token = '5417056616:AAF5a7xcWoRL_gKUs0OfH2Th1lR5Qh88YFQ';

$getUpdatesUri = sprintf('https://api.telegram.org/bot%s/getUpdates', $token);
$sendMessageUri = sprintf('https://api.telegram.org/bot%s/sendMessage', $token);

$requestParameters = [
    'offset' => null
];

while (true) {

    $updates = json_decode(file_get_contents($getUpdatesUri . '?' . http_build_query(
            $requestParameters
        )), true);

    foreach ($updates['result'] as $update) {

        $rates = json_decode(file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5'), true);

        $name = explode(' ', $update['message']['text']);
        $ccy_number = $name[0];
        $ccy_name = $name[1];

        $baseCcy = 'UAH';
        $ccy = $ccy_name;
        $amount = $ccy_number;

        $rate = null;
        foreach ($rates as $item) {
            if ($item['ccy'] === $ccy & $item['base_ccy'] === $baseCcy) {
                $rate = $item;
                break;
            }
        }
        if ($rate === null) {
            throw new Exception('Курс не найден');
        }


        $responseParameters = [
            'chat_id' => $update['message']['chat']['id'],
            'text' => $amount . ' ' . $ccy . ' = ' . $amount * $rate['sale'] . ' ' . $baseCcy,
        ];

        file_get_contents($sendMessageUri . '?' . http_build_query($responseParameters));

        $requestParameters['offset'] = $update['update_id'] + 1;

        echo "Last Update ID: {$update['update_id']}\n";
    }
}
