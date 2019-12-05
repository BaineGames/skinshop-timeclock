<?php

require_once('../db.php');

$data = array();

$input = json_decode(file_get_contents('php://input'),true);

$projectId = $input['projectId'];
$notes = $input['notes'];

$userId = $_SESSION['user_id'];

try {
    $stmt = $db->prepare("UPDATE timeclock SET clock_out = CURRENT_TIMESTAMP, out_notes = :notes WHERE project_id = :project_id AND user_id = :user_id AND clock_out = '0000-00-00 00:00:00'");
    $stmt->bindParam(':user_id',$userId,PDO::PARAM_INT);
    $stmt->bindParam(':project_id',$projectId,PDO::PARAM_INT);
    $stmt->bindParam(':notes',$notes,PDO::PARAM_STR);
    $stmt->execute();        
    $data['state'] = true;
    print_r(json_encode($data));

} catch(PDOException $e) {
    $data['state'] = false;
    $data['errorMsg'] = $e->getMessage();
    print_r(json_encode($data));
}

?>