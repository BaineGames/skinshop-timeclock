<?php

require_once('../db.php');

$data = array();

$input = json_decode(file_get_contents('php://input'),true);

$startDate = $input['startDate'];
$endDate = $input['endDate'];
$withNotes = $input['withNotes'];
$user_id = $_SESSION['user_id'];

if(!$endDate){
    $date_sql = " DATE(timeclock.clock_in) = :start_date ";
}else{
    $date_sql = " DATE(timeclock.clock_in) BETWEEN :start_date AND :end_date ";
}

if($withNotes){
    
}

$sql = "SELECT project_name, DATE(timeclock.clock_in) AS clock_date, SUM(time_to_sec(timediff(timeclock.clock_out, timeclock.clock_in )) / 3600) AS total_hours FROM timeclock INNER JOIN projects ON timeclock.project_id = projects.project_id WHERE timeclock.user_id = :user_id AND $date_sql GROUP BY 1,2 ORDER BY 2,1 ASC";





try {
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':user_id',$user_id,PDO::PARAM_INT);
    $stmt->bindParam(':start_date',$startDate,PDO::PARAM_STR);
    if($endDate){
        $stmt->bindParam(':end_date',$endDate,PDO::PARAM_INT);
    }

    $stmt->execute(); 
    
    
    
    if($stmt->rowCount()){

        while($reportData = $stmt->fetch(PDO::FETCH_ASSOC)){
          
            $data['data'][] = $reportData;
        }
        $data['state'] = true;

        print_r(json_encode($data));
    }else{
        $data['state'] = false;
        $data['errorNo'] = 101;
        $data['errorMsg'] = "No Data";
        print_r(json_encode($data));
    }


} catch(PDOException $e) {
    $data['state'] = false;
    $data['errorMsg'] = $e->getMessage();
    print_r(json_encode($data));
}

?>