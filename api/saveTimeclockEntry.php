<?php

require_once('../db.php');

$data = array();

$input = json_decode(file_get_contents('php://input'),true);

$timeclock_id = $input['timeclock_id'];
$startDate = $input['startDate'];
$endDate = $input['endDate'];
$inNotes = $input['inNotes'];
$outNotes = $input['outNotes'];


try {
    $stmt = $db->prepare("UPDATE timeclock SET clock_in = :startDate, clock_out = :endDate, in_notes = :inNotes, out_notes = :outNotes WHERE timeclock_id = :timeclock_id");
    $stmt->bindParam(':startDate',$startDate,PDO::PARAM_STR);
    $stmt->bindParam(':endDate',$endDate,PDO::PARAM_STR);
    $stmt->bindParam(':inNotes',$inNotes,PDO::PARAM_STR);
    $stmt->bindParam(':outNotes',$outNotes,PDO::PARAM_STR);
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