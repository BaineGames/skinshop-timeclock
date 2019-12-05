<?php

require_once('../db.php');

$data = array();

try {
    $stmt = $db->prepare("SELECT project_id, project_name FROM projects WHERE status = 1 ORDER BY project_name ASC");
    $stmt->execute();
    if($stmt->rowCount()){
        $data['state'] = true;
        while($projects = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data['data'][] = $projects;
        }

        print_r(json_encode($data));
    }else{
        $data['state'] = false;
        $data['errorNo'] = 101;
        $data['errorMsg'] = "Cannot load project data";
        print_r(json_encode($data));
    }
} catch(PDOException $e) {
    $data['state'] = false;
    $data['errorMsg'] = $e->getMessage();
    print_r(json_encode($data));
}
?>