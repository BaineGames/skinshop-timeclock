<?php require_once('./_header.php'); ?>

    <div class='grid-container'>
        <div class='grid-x'>
            <div class='cell'>
                Start Date:
                <input type='date' id='startDate'>
            </div>
            <div class='cell'>
                End Date:
                <input type='date' id='endDate'>
            </div>
            <div class='cell'>
                <a href="#" id='runReport' class="expanded button">Report</a>
                <hr>
            </div>
            
            <h4>Report</h4>
            <div class='cell'>

                <table id='reportData' class="stack">
                    <thead>
                        <th>Project</th>
                        <th>Date</th>
                        <th id='hoursText'>Hours</th>
                    </thead>
                    <tbody></tbody>
                    <tfoot></tfoot>
                </table>

            </div>
        </div>
    </div>


    <?php require_once('./_footer.php'); ?>