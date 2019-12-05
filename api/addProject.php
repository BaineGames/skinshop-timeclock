<?php

require_once('../db.php');

$data = array();

$input = json_decode(file_get_contents('php://input'),true);

$projectName = $input['projectName'];


try {
    $stmt = $db->prepare("INSERT INTO projects (project_name) VALUES(:project_name)");
    $stmt->bindParam(':project_name',$projectName,PDO::PARAM_STR);

    $stmt->execute();        

    $data['state'] = true;

    print_r(json_encode($data));


} catch(PDOException $e) {
    $data['state'] = false;
    $data['errorMsg'] = $e->getMessage();
    print_r(json_encode($data));
}

?>