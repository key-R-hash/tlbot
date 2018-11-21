<?php
    global $update_id;
    global $request;
    $request = file_get_contents( 'php://input' );
    $request = json_decode( $request, TRUE );
    $update_id = $request['update_id'];
    $connection = new mysqli('localhost','kiarash','Skills39*','wp');
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $query_str = "SELECT  `chat_id` FROM `login` where `update_id` = $update_id ";
    $query = $connection->query($query_str);
    $a = $query->fetch_assoc();
    $query_str = "SELECT  `chat_id` FROM `login` where `update_id` = $update_id ";
    $query = $connection->query($query_str);
    $b= $query->fetch_assoc();
    if($a == null && $b == null){
        bot();
    }
function bot(){
    global $request;
    global $first;
    $first = $request['message']['text'];

    if($first == '/start'){
        global $chatId;

        $chatId = $data['message']['from']['id'];


        $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=Hello this is insert wordpress bot";
        file_get_contents($url);
    }else{
        return;
    }
    require_once '../../../../wp-load.php';
    include_once 'function.php';
    global $connection;
$connection = new mysqli('localhost','kiarash','Skills39*','wp');
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
    
$query_str = 'SELECT `b` FROM `variable`';

$query = $connection->query($query_str);
$start = $query->fetch_assoc();
$keyboard = array(array("-username-","-password-","-finish_login-"),array("-start-"),array("-title-","-body-"),array("-finish-"));
$resp = array("keyboard" => $keyboard,"resize_keyboard" => true,"one_time_keyboard" => true);
$reply = json_encode($resp);
$query_str = "SELECT  `chat_id` FROM `login` where chat_id = $chatId and status = 1";
$query = $connection->query($query_str);
$as = $query->fetch_assoc();
if($as == null){
    $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=hello inter username&reply_markup=".$reply;

}else{
    $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=hello&reply_markup=".$reply;

}

file_get_contents($url);

if($start['b'] == 1){       
        global $update_id;
        $action = query_function();
        $function =  query_massage();    
        // $get = getfirst();

        if(in_array($first,$action)){
            query($get);
        }else{
            $query_str = "UPDATE `tbl-message` SET `massege` = $get, `update_id` = $update_id where `chat_id` = $chatId and `status` = 0 `functions` = $function";
            $query = $connection->query($query_str);
        }
    }
} 

bot();