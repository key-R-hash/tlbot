<?php

    // function getfirst(){
    //     $data = file_get_contents("https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/getUpdates");
    //     $data = json_decode($data, true);
    //     $count = count($data['result']) - 1 ;
    //     $data = $data['result'][$count]['message']['text'];
    //     return $data;
    // }
    
    // function getsecond(){
    //     $data = file_get_contents("https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/getUpdates");
    //     $data = json_decode($data, true);
    //     $count = count($data['result']) - 2 ;
    //     $data = $data['result'][$count]['message']['text'];
    //     return $data;
    // }
 function query_login(){
    global $chatId;

    $connection = new mysqli('localhost','kiarash','Skills39*','wp');
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } 
    $query_str = "SELECT `functions` FROM `login` where `chat_id` = $chatId and status = 0 ORDER BY `id` DESC LIMIT 1";
    $query = $connection->query($query_str);
    while($mas = $query->fetch_assoc()){

        $ms = $mas['functions'];
    }
    return $ms;
 
 }
 function login(){
    global $chatId;

    $connection = new mysqli('localhost','kiarash','Skills39*','wp');
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } 
    $query_str = "SELECT `login` FROM `tbl-massage` where `chat_id` = $chatId and status = 0 ORDER BY `id` DESC LIMIT 1";
    $query = $connection->query($query_str);
    while($mas = $query->fetch_assoc()){

        $ms = $mas['login'];
    }
    return $ms;
 }
 function query_massage(){
    global $chatId;

    $connection = new mysqli('localhost','kiarash','Skills39*','wp');
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } 
    $query_str = "SELECT `functions` FROM `tbl-massage` where `chat_id` = $chatId and status = 0 ORDER BY `id` DESC LIMIT 1";
    $query = $connection->query($query_str);
    while($mas = $query->fetch_assoc()){

        $ms = $mas['functions'];
    }
    return $ms;
}
function query_massage_id(){
    global $chatId;

    $connection = new mysqli('localhost','kiarash','Skills39*','wp');
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $query_str = "SELECT `id` FROM `tbl-massage` where `chat_id` = $chatId ORDER BY `id` DESC LIMIT 1";
    $query = $connection->query($query_str);

    while($mas = $query->fetch_assoc()){
        $ms = $mas['id'];
    }
    return $ms;
}
function query_function(){

    $connection = new mysqli('localhost','kiarash','Skills39*','wp');
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $query_str = "SELECT `-command-` FROM `tbl-function`";
    $query = $connection->query($query_str);

    while($fun = $query->fetch_assoc()){

        $fu[] = $fun['-command-'];
    }

    return $fu;
}
function query($massage){

    global $update_id;
$now = time();

    global $chatId;


$connection = new mysqli('localhost','kiarash','Skills39*','wp');
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$query_str = "SELECT  `chat_id` FROM `login` where chat_id = $chatId and status = 1";

$query = $connection->query($query_str);
$as = $query->fetch_assoc();
$as = $as['chat_id'];

if($massage == '-username-'){
    global $update_id;
    $query_str = "SELECT  `username` FROM `login` where chat_id = $chatId and `status` = 0 and `functions` = '-username-'";
    $query = $connection->query($query_str);
    $posts = $query->fetch_assoc();

    if($posts == null){

        $query_str = "INSERT INTO `login`(`functions`,`chat_id`, `username`,`status`,`password`,`date`) VALUES ('-username-',$chatId,'0','0','0',$now)";
	$query = $connection->query($query_str);
        $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=username:";
        file_get_contents($url); 
        die();

    }

}
if($massage == '-password-'){
    $query_str = "SELECT  `username` FROM `login` where chat_id = $chatId and `status` = 0 and `functions` = '-password-'";
    $query = $connection->query($query_str);
    $posts = $query->fetch_assoc();
    if($posts == null){
        $query_str = "UPDATE `login` SET `functions` = '-password-'  where `chat_id` = $chatId ";
        $query = $connection->query($query_str);

        $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=password: ";
        file_get_contents($url);
        die();

    }

}
if($massage == '-finish_login-'){
    $query_str = "SELECT  `password`,`username` FROM `login` where chat_id = $chatId and status = 1";
    $query = $connection->query($query_str);
    $posts = $query->fetch_assoc();

    $query_str = "SELECT  `password`,`username` FROM `login` where chat_id = $chatId and `status` = 0 ";
    $query = $connection->query($query_str);
    $user = $query->fetch_assoc();

    $login = wp_login($user['username'],$user['password'],'wp_signon()');

    if($posts == null && $login == 1){
        
        $username = "'" . $data . "'";
        $query_str = "UPDATE `login` SET `status`= 1 where chat_id = $chatId ";
        $query = $connection->query($query_str);
        $query_str = "INSERT INTO `tbl-massage`(`chat_id`, `body`,`title`,`status`,`functions`,`login`,`date`) VALUES ($chatId,'0','0','0','-finish_login-','1',$now)";
        $query = $connection->query($query_str);
        $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=inter your title";
        file_get_contents($url);
        die();
    }elseif($login == 0 || $login == null){

        $query_str = "DELETE FROM `login` WHERE `chat_id` = $chatId ";
        $query = $connection->query($query_str); 
        $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=your username or password incorrect please inter your username and password again";
        file_get_contents($url);
        die();
    }
}

if($massage == '-title-' || $massage == '-body-' || $massage == '-finish-' || $massage == '-start-' && $as != null){
    if($massage == '-start-'){
    $query_str = "SELECT  `password`,`username` FROM `login` where chat_id = $chatId and `status` = 1 ";
    $query = $connection->query($query_str);
    $user = $query->fetch_assoc();

    $login = wp_login($user['username'],$user['password'],'wp_signon()');

    if($login == 1){
        $query_str = "INSERT INTO `tbl-massage`(`chat_id`, `body`,`title`,`status`,`functions`,`login`,`date`) VALUES ($chatId,'0','0','0','-finish_login-','1',$now)";
        $query = $connection->query($query_str);
        $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=inter your title";
        file_get_contents($url);
        die();
    }
    }
    if($massage == '-title-'){
        global $update_id;
        $query_str = "SELECT  `title` FROM `tbl-massage` where `chat_id` = $chatId and `status` = 0 and `functions` = '-title-'";
        $query = $connection->query($query_str);
        $posts = $query->fetch_assoc();
        if($posts == null){
            $query_str = "UPDATE `tbl-massage` SET `functions` = '-title-'  where `chat_id` = $chatId ";
            $query = $connection->query($query_str);
            $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=title:";
            file_get_contents($url); 
            die();                   
        }

    }
    if($massage == '-body-'){
        global $update_id;

        $query_str = "SELECT  `body` FROM `tbl-massage` where `chat_id` = $chatId and `status` = 0 and `functions` = '-body-'";
        $query = $connection->query($query_str);
        $posts = $query->fetch_assoc();
        if($posts == null){          
            $query_str = "UPDATE `tbl-massage` SET `functions` = '-body-'  where `chat_id` = $chatId ";
            $query = $connection->query($query_str);

            $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=body:";
            file_get_contents($url);
            die();

        }
    }
    if($massage == '-finish-'){
        $query_str = "SELECT  `body`,`title` FROM `tbl-massage` where chat_id = $chatId and status = 0";

        $query = $connection->query($query_str);
        while($posts = $query->fetch_assoc()){

            $post[] = $posts;
        }
        if(!empty($post)){

            insert( $post[0]['title'], $post[0]['body']);
            $query_str = "UPDATE `tbl-massage` SET `status`= 1 where chat_id = $chatId ";
            $query = $connection->query($query_str);
            $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=Your post is ready now";
            file_get_contents($url);  
            die();

        }
        
    }
}

}
