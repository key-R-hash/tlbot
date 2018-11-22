<?php
    global $update_id;
    global $request;
    $request = file_get_contents( 'php://input' );

  $request = json_decode( $request, TRUE );

 //   $update_id = $request['update_id'];
 //   $connection = new mysqli('localhost','kiarash','Skills39*','wp');
 //   if ($connection->connect_error) {
  //      die("Connection failed: " . $connection->connect_error);
  //  }
 //   $query_str = "SELECT  `chat_id` FROM `login` where `update_id` = $update_id ";

  //  $query = $connection->query($query_str);
  //  $a = $query->fetch_assoc();
 //   $a = $a['chat_id'];

  //  $query_str = "SELECT  `chat_id` FROM `login` where `update_id` = $update_id ";
   // $query = $connection->query($query_str);
   // $b= $query->fetch_assoc();
    //$b = $b['chat_id'];
   //if($a == null && $b == null){
        bot();
   // }
function bot(){
    global $request;
    global $first;
    $first = $request['message']['text'];
    global $chatId;
    $chatId = $request['message']['from']['id'];

    global $connection;
	$connection = new mysqli('localhost','kiarash','Skills39*','wp');
	if ($connection->connect_error) {
    	die("Connection failed: " . $connection->connect_error);
	}

    if($first == '/start'){

        $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=Hello this is insert wordpress bot";
        file_get_contents($url);
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

    die();

    }
    require_once '../../../../wp-load.php';
    include_once 'function.php';
    include_once 'insert_post.php';
$query_str = 'SELECT `b` FROM `variable`';

$query = $connection->query($query_str);
$start = $query->fetch_assoc();

if($start['b'] == 1){ 

            // $get = getfirst();

        global $update_id;
        $action = query_function();
        $login = login();   

        if($login == 1){
            $access = 1;
            $function =  query_massage();
        }else{
            $access = 0;
            $function =  query_login();

        }

        if(in_array($first,$action)){

            query($first);
        } else{
            if($access == 1){
		$f = "'$first'";
		$fu = "'$function'";
		if($function == '-title-'){
                $query_str = "UPDATE `tbl-massage` SET `title` = $f where `chat_id` = $chatId and `status` = 0 and `functions` = $fu";
                $query = $connection->query($query_str);
   	        $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=inter your body";
                file_get_contents($url);
		die();
		}
		if($function == '-body-'){
                $query_str = "UPDATE `tbl-massage` SET `body` = $f where `chat_id` = $chatId and `status` = 0 and `functions` = $fu";
                $query = $connection->query($query_str);

   	        $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=inter finish";
                file_get_contents($url);
		die();
		}
            }
            if($access == 0){
		$f = "'$first'";
		$fu = "'$function'";
		if($function == '-username-'){
                $query_str = "UPDATE `login` SET `username` = $f where `chat_id` = $chatId and `status` = 0 and `functions` = $fu";
                $query = $connection->query($query_str);
   	        $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=inter your password";
                file_get_contents($url);
		die();
		}
		if($function == '-password-'){
                $query_str = "UPDATE `login` SET `password` = $f where `chat_id` = $chatId and `status` = 0 and `functions` = $fu";
                $query = $connection->query($query_str);
   	        $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=inter finish login";
                file_get_contents($url);
		die();
		}
            }            
        }  

    }
} 

bot();