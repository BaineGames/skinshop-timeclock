<?php

require_once('../db.php');

$data = array();

$input = json_decode(file_get_contents('php://input'),true);

$timeclock_id = $input['timeclock_id'];


try {
    $stmt = $db->prepare("DELETE FROM timeclock WHERE timeclock_id = :timeclock_id");
    $stmt->bindParam(':timeclock_id',$timeclock_id,PDO::PARAM_INT);

    $stmt->execute();        

    $data['state'] = true;

    print_r(json_encode($data));


} catch(PDOException $e) {
    $data['state'] = false;
    $data['errorMsg'] = $e->getMessage();
    print_r(json_encode($data));
}

?>