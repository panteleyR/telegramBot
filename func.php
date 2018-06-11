<?php

function connectBD(){
    $hostname='localhost';

    $username="u0512445_default";
    $password="_HV9JgZ7";
    $dbname="u0512445_default";
    $usertable="your_tablename";
    $yourfield = "your_field";
    $charset = 'utf8';


    $dsn = "mysql:host=$hostname;dbname=$dbname;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_PERSISTENT => true,
    ];
    $pdo = new PDO($dsn, $username, $password, $opt);
}



/*
function test(){
    $myCurl = curl_init();
    curl_setopt_array($myCurl, array(
        CURLOPT_URL => 'http://rasp.dmami.ru/site/group?group=161-511&session=0',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query(array())
    ));
    $response = curl_exec($myCurl);
    $response =parsJson($response);
    print_r($response);
    curl_close($myCurl);

}
test();*/

function tellBotMosPoly(){
    $getMess=updateMes();
    print_r($getMess);
    $output = file_get_contents('php://input');
    print_r('php://input');

    print_r('gufi');
    print_r($output);
    print_r('gufi');
    print_r($_GET);print_r($_POST);
    print_r('gufi');

    /* if(responTrue($getMess) and newMess($getMess) and notEmptyMess($getMess)){
         $user=takeInfo($getMess);
          print_r($user);
         switchCommand(/*$user['text'],$user['chatId']$user);
     }
     sleep(2);*/
    /*tellBotMosPoly();*/
}


function updateMes(){
    $myCurl = curl_init();
    $murl='https://mospolybot.ru/bot.php';

    curl_setopt_array($myCurl, array(
        CURLOPT_URL => 'https://api.telegram.org/bot606822643:AAGAMTVJRmbRPIXB6UyRr-ZD1j6xvGqDWjQ/setWebhook',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SAFE_UPLOAD => false,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query(array('url' => $murl))
    ));
    $response = curl_exec($myCurl);
    $response =parsJson($response);
    /*print_r($response);*/
    curl_close($myCurl);

    return $response;
}
function parsJson($json){
    return json_decode($json, true);
}

function sendMessage($idChat, $text, $pointer){
    $myCurl = curl_init();
    curl_setopt_array($myCurl, array(
        CURLOPT_URL => 'https://api.telegram.org/bot571761655:AAFfxMWDrOttSqTz1fCdJSeIBXCEe6uMh-A/sendMessage',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query(array(
            'chat_id'=> $idChat,
            'text' => $text
        ))
    ));
    curl_exec($myCurl);
    curl_close($myCurl);
    $fp = fopen('counter.txt', 'w');
    fwrite($fp, $pointer);
    fclose($fp);

}

function responTrue($mes){
    if($mes['ok'] == 'true' or $mes['ok'] == true){
        return true;
    }
    else{
        return false;
    }
}
function takeNewUp($mes1){
    return $mes1['result'][count($mes1['result'])-1];
}
function takeInfo($obj){
    $point=count($obj['result'])-1;
    $susuke=takeNewUp($obj);

    /* $user['chatId']=$susuke['message']['chat']['id'];
     $user['text']=$susuke['message']['text'];*/
    return array(
        'chatId'=> $susuke['message']['chat']['id'],
        'name' => $susuke['message']['chat']['username'],
        'text'=> $susuke['message']['text'],
        'point' => $point
    )
        ;
}

function newMess($mes){
    $numAc=count($mes['result'])-1;

    $fp = fopen('counter.txt', 'r');
    $numDone= fread($fp,1024);
    $numDone = intval($numDone);
    if($numAc == $numDone){
        fclose($fp);
        return false;
    }
    else{
        fclose($fp);
        return true;
    }
}

function notEmptyMess($mes){
    if($mes['result'] !== Array()){
        return true;
    }
    else{
        $fp = fopen('counter.txt', 'w');
        fwrite($fp,"0");

        return false;
    }
}

function getCommand($slova){
    $str=[];
    $arr = preg_split("/( )+/", $slova);
    foreach ($arr as $word) {
        $str[]=$word;

    }
    return $str;
}
function getRasp($group){
    /*asfsafasf*/

}
function switchCommand($user/*$text,$chatId*/){
    print_r($user['text']);
    if($user['text']){
        $command = getCommand($user['text']);


        switch ($command[0]){
            case '/blo':
                $moyOtvet='huy';
                sendMessage($user['chatId'],$moyOtvet,$user['point']);
                break;
            case '/rasp':
                $moyOtvet=getRasp($command[1]);
                sendMessage($user['chatId'],$moyOtvet,$user['point']);
                break;
            case '/starts':
                $moyOtvet='Приветствую тебя, мой друг '.$user['name'].', в приложение от студентов и для студентов Московского Политеха, которое, я надеюсь, облегчит тебе путь в познании гранита науки. Напиши команду /help, чтобы увидеть список всех возможных командю
            ';
                sendMessage($user['chatId'],$moyOtvet,$user['point']);
                break;
        }

    }

}







/*
$myCurl = curl_init();
curl_setopt_array($myCurl, array(
    CURLOPT_URL => 'https://api.telegram.org/bot571761655:AAFfxMWDrOttSqTz1fCdJSeIBXCEe6uMh-A/getUpdates',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query(array())
));
$response = curl_exec($myCurl);
curl_close($myCurl);

echo "Ответ на Ваш запрос: ".$response;
*/
