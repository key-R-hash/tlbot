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
 function query_massage(){
    global $chatId;

    $connection = new mysqli('localhost','kiarash','Skills39*','wp');
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } 
    $query_str = "SELECT `message` FROM `tbl-massage` where `chat_id` = $chatId and status = 0 ORDER BY `id` DESC LIMIT 1";
    $query = $connection->query($query_str);
    while($mas = $query->fetch_assoc()){

        $ms = $mas['message'];
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
    global $chatId;
$connection = new mysqli('localhost','kiarash','Skills39*','wp');
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$query_str = "SELECT  `chat_id` FROM `login` where chat_id = $chatId and status = 1";
$query = $connection->query($query_str);
$as = $query->fetch_assoc();

if($massage == '-username-'){
    global $update_id;

    $query_str = "SELECT  `username` FROM `login` where chat_id = $chatId and `status` = 0 and `functions` = '-username-'";
    $query = $connection->query($query_str);
    $posts = $query->fetch_assoc();

    if($posts == null){
        $query_str = "INSERT INTO `login`(`chat_id`, `username`,`status`,`update_id`) VALUES ($chatId,'-username-','0',$update_id)";
        $query = $connection->query($query_str);

        $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=inter your password";
        file_get_contents($url);                
    }

}
if($massage == '-password-'){
    global $update_id;
    $query_str = "SELECT  `username` FROM `login` where chat_id = $chatId and `status` = 0 and `functions` = '-password-'";
    $query = $connection->query($query_str);
    $posts = $query->fetch_assoc();
    if($posts == null){
        $query_str = "UPDATE `login` SET `password` = '-password-',`update_id` = $update_id where `chat_id` = $chatId ";
        $query = $connection->query($query_str);

        $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=inter finish_login ";
        file_get_contents($url);
        
    }

}
if($massage == '-finish_login-'){
    global $update_id;
    $query_str = "SELECT  `password`,`username` FROM `login` where chat_id = $chatId and status = 1";
    $query = $connection->query($query_str);
    $posts = $query->fetch_assoc();

    $query_str = "SELECT  `password` FROM `login` where chat_id = $chatId and `status` = 0 ";
    $query = $connection->query($query_str);
    $password = $query->fetch_assoc();
    
    $query_str = "SELECT  `username` FROM `login` where chat_id = $chatId and `status` = 0";
    $query = $connection->query($query_str);
    $username = $query->fetch_assoc();
    $login = wp_login($username['username'],$password['password'],'wp_signon()');
    
    if($posts == null && $login == 1){
        
        $username = "'" . $data . "'";
        $query_str = "UPDATE `login` SET `status`= 1,`update_id` = $update_id where chat_id = $chatId ";
        $query = $connection->query($query_str);
        $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=inter your title";
        file_get_contents($url);
    }
}

if($massage == '-title-' || $massage == '-body-' || $massage == '-finish-' && $as != null){
    if($massage == '-title-'){
        global $update_id;

        $query_str = "SELECT  `message` FROM `tbl-massage` where `chat_id` = $chatId and `status` = 0 and `function` = '-title-'";
        $query = $connection->query($query_str);
        $posts = $query->fetch_assoc();
        if($posts == null){
            $query_str = "INSERT INTO `tbl-massage`(`chat_id`, `message`,`status`,`update_id`) VALUES ($chatId,$data,'0',$update_id)";
            $query = $connection->query($query_str);
            $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=inter your body";
            file_get_contents($url);                    
        }

    }
    if($massage == '-body-'){
        global $update_id;

        $query_str = "SELECT  `message` FROM `tbl-massage` where `chat_id` = $chatId and `status` = 0 and `function` = '-body-'";
        $query = $connection->query($query_str);
        $posts = $query->fetch_assoc();
        if($posts == null){                
            $query_str = "INSERT INTO `tbl-massage`(`chat_id`, `message`,`status`,`update_id`) VALUES ($chatId,$data,'0',$update_id)";
            $query = $connection->query($query_str);

            $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=inter finish";
            file_get_contents($url);
        }
    }
    if($massage == '-finish-'){
        global $update_id;

        $query_str = "SELECT  `message` FROM `tbl-massage` where chat_id = $chatId and status = 0";
        $query = $connection->query($query_str);
        while($posts = $query->fetch_assoc()){

            $post[] = $posts['message'];
        }
        if(!empty($post)){
            $query_str = "INSERT INTO `tbl-massage`(`chat_id`, `message`,`status`,`update_id`) VALUES ($chatId,'-finish-','1',$update_id)";
            $query = $connection->query($query_str);
            insert($post[0],$post[1]);
            $query_str = "UPDATE `tbl-massage` SET `status`= 1 where chat_id = $chatId ";
            $query = $connection->query($query_str);
            $url = "https://api.telegram.org/bot734973442:AAG-xo0OWhcPhrJGNX1fBrNvmq2D4G0KVN8/sendmessage?chat_id=".$chatId."&text=Your post is ready now";
            file_get_contents($url);  
        }
        
    }
}

}
