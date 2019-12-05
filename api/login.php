<?php

require_once('../db.php');

$data = array();

$input = json_decode(file_get_contents('php://input'),true);

$username = $input['username'];
$password = $input['password'];


try {
    $stmt = $db->prepare("SELECT user_id FROM users WHERE username = :username AND password = :password");
    $stmt->bindParam(':username',$username,PDO::PARAM_STR);
    $stmt->bindParam(':password',$password,PDO::PARAM_STR);
    $stmt->execute();        
    if($stmt->rowCount()){ 
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['session_id'] = session_id();
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user_data['user_id'];
        $data['state'] = true;
        $data['session'] = $_SESSION;
        print_r(json_encode($data));
    }else{
        $data['state'] = false;
        $data['errorMsg'] = "Bad Shit";
        print_r(json_encode($data));
    }

} catch(PDOException $e) {
    $data['state'] = false;
    $data['errorMsg'] = $e->getMessage();
    print_r(json_encode($data));
}

?>