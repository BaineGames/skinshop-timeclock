<?php require_once('./_header.php'); ?>

<div class='grid-container'>
    <div class='grid-x'>
       <h4>Edit Timeclock Entries</h4>
        <div class='cell'>
            <table id='clockActivity' class="stack">
                <thead>
                    <th>Project</th>
                    <th>Clock In</th>
                    <th>Clock Out</th>
                    <th>Hours</th>
                    <th>Notes</th>
                    <th>Action</th>
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
        populateClockActivity('all');
    });
</script>