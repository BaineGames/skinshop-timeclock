<?php require_once('./_header.php'); ?>

    <div class='grid-container'>
        <div class='grid-x'>
            <h4>Timeclock</h4>
            <div class='cell'>
                Project:
                <select id='projectList'></select>
            </div>
            <div class='cell'>
               Notes:
                <textarea id='timeclockNotes'></textarea>
            </div>
            <div class='cell'>
                <a href="#" id='clockIn' class="expanded button">Clock In</a>
            </div>

            <div class='cell'>
                <a href="#" id='clockOut' class="expanded button">Clock Out</a>
                <hr>
            </div>
            <h4>Daily Activity</h4>
            <div class='cell'>
                <table id='clockActivity' class="stack">
                    <thead>
                        <th>Project</th>
                        <th>Clock In</th>
                        <th>Clock Out</th>
                        <th>Hours</th>
                        <th>Notes</th>
                    </thead>
                    <tbody></tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
    </div>
    
<?php require_once('./_footer.php'); ?>


<script>
$(document).ready(function(){
    populateProjectList(); 
    populateClockActivity();
});
</script>