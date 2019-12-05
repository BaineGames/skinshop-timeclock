<?php

require_once('../db.php');

$data = array();

$input = json_decode(file_get_contents('php://input'),true);

$projectId = $input['projectId'];


try {
    $stmt = $db->prepare("UPDATE projects SET status = 0 WHERE project_id = :project_id");
    $stmt->bindParam(':project_id',$projectId,PDO::PARAM_INT);

    $stmt->execute();        

    $data['state'] = true;

    print_r(json_encode($data));


} catch(PDOException $e) {
    $data['state'] = false;
    $data['errorMsg'] = $e->getMessage();
    print_r(json_encode($data));
}

?>