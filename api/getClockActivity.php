<?php

require_once('../db.php');

$data = array();

$flag = $_GET['showall'];

if($flag == 'true'){
    $sql = "SELECT timeclock_id, project_name, clock_in, clock_out, in_notes, out_notes FROM timeclock INNER JOIN projects ON timeclock.project_id = projects.project_id WHERE timeclock.user_id = :user_id AND projects.status = 0 ORDER BY clock_in DESC";
}else{
    $sql = "SELECT timeclock_id, project_name, clock_in, clock_out, in_notes, out_notes FROM timeclock INNER JOIN projects ON timeclock.project_id = projects.project_id WHERE timeclock.user_id = :user_id AND DATE(timeclock.clock_in) = CURDATE() AND projects.status = 0 ORDER BY clock_in DESC";
}

try {
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':user_id',$_SESSION['user_id'],PDO::PARAM_INT);
    $stmt->execute();
    if($stmt->rowCount()){
        $data['state'] = true;
        while($timeclocks = $stmt->fetch(PDO::FETCH_ASSOC)){
            $clock_in = $timeclocks['clock_in'];
            $clock_out = $timeclocks['clock_out'];
            if($clock_out == '0000-00-00 00:00:00'){
                $diff = 0;
            }else{
                $diff = round(abs(strtotime($clock_out) - strtotime($clock_in)) / 60 / 60,2);
            }
            
            $timeclocks['hours'] = $diff;
            $data['data'][] = $timeclocks;
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