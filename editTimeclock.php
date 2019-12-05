<?php require_once('./_header.php'); ?>


<?php

$timeclock_id = $_GET['id'];

require_once('./db.php');


    $stmt = $db->prepare("SELECT clock_in, clock_out, in_notes, out_notes FROM timeclock WHERE timeclock_id = :timeclock_id");
    $stmt->bindParam(':timeclock_id',$timeclock_id,PDO::PARAM_INT);

    $stmt->execute();
    
    while($entry = $stmt->fetch(PDO::FETCH_ASSOC)){

        $clock_in = $entry['clock_in'];
        $clock_out = $entry['clock_out'];
        $in_notes = $entry['in_notes'];
        $out_notes = $entry['out_notes'];
    }


?>
<div class='grid-container'>
    <div class='grid-x'>
        <h4>Edit Timeclock Entry</h4>
        <div class='cell'>
            Timeclock ID:
            <input type=number id='timeclock_id' disabled value='<?php echo $timeclock_id; ?>'>
        </div>
        <div class='cell'>
            Start Date:
            <input type=text id='startDate'  value='<?php echo $clock_in; ?>'>
        </div>
        <div class='cell'>
            End Date:
            <input type=text id='endDate'  value='<?php echo $clock_out; ?>'>
        </div>
        <div class='cell'>
            In Notes:
            <textarea id='inNotes'><?php echo $in_notes; ?></textarea>
        </div>
        <div class='cell'>
            Out Notes:
            <textarea id='outNotes'><?php echo $out_notes; ?></textarea>
        </div>
        <div class='cell'>
            <a href='#' id='saveTimeclock' class='button expanded'>Save</a>
        </div>
    </div>
</div>


<?php require_once('./_footer.php'); ?>


