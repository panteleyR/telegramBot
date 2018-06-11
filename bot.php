<?php  echo 'фыапфыафы';
include_once ('func.php');
?>
<!DOCTYPE html>
<html>
<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body><h1>Result</h1>

<a href="/bot.php" style="cursor: pointer; padding: 10px; border-radius: 10px;border: 2px solid black; background: yellow;" class="refTel">Refresh </a>

<a class="ajax-test">AJAX</a>


<br><br><br><br>
<div class="messages">
    <pre>


    <?php

    $output = json_decode(file_get_contents('php://input'),true);
    print_r($output);
    print_r('POst:');
   print_r($_POST);

    print_r('_________________');

    /*tellBotMosPoly();*/?>


        <?php
$cert='cert.pem';
    $myCurl = curl_init();
    $murl='https://mospolybot.ru/bot.php';
    print_r('@'.realpath($cert));

  print_r($murl);

    $botKey='571761655:AAFfxMWDrOttSqTz1fCdJSeIBXCEe6uMh-A';
    $botttt='606822643:AAGAMTVJRmbRPIXB6UyRr-ZD1j6xvGqDWjQ';
    curl_setopt_array($myCurl, array(
        CURLOPT_URL => 'https://api.telegram.org/bot'.$botKey.'/setWebhook',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SAFE_UPLOAD => false,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => /*array(*/http_build_query(array('url' => $murl))/*, 'certificate' => '@' . realpath($cert))*/
    ));
    $response = curl_exec($myCurl);
    $response =parsJson($response);
    /*print_r($response);*/
    curl_close($myCurl);
    print_r($response);
    ?>
    </pre>
</div>
<!--
<script src="script.js"></script>
-->

<div>
    <?php
    /*
    $phantom_script= dirname(__FILE__). '/get.js';


    $response =  exec ('phantomjs ' . $phantom_script);

    print_r(  htmlspecialchars($response));*/
    ?>
</div>
</body>
</html>