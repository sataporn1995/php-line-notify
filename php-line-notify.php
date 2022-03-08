<?php
define('LINE_API', "https://notify-api.line.me/api/notify");
define('LINE_TOKEN', "<API TOKEN KEY>");

function notify_message($message)
{
    $queryData = array('message' => $message);
    $queryData = http_build_query($queryData, '', '&');
    $headerOptions = array(
        'http' => array(
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                . "Authorization: Bearer " . LINE_TOKEN . "\r\n"
                . "Content-Length: " . strlen($queryData) . "\r\n",
            'content' => $queryData
        ),
    );
    $context = stream_context_create($headerOptions);
    $result = file_get_contents(LINE_API, FALSE, $context);
    $res = json_decode($result);
    return $res;
}


$msg = "TITLE: SAYHI" . "\nNAME: ADMIN" . "\nDATE: 2022-01-01";
$res = notify_message($msg);
echo json_encode($res);

