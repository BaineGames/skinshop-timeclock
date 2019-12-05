<?php require_once('./_header.php'); ?>


    <div class='grid-container'>
        <div class='grid-x'>
            <h4>Add Project</h4>
            <div class="cell">
                Project Name:
                    <input type="text" id='projectName'>
                
            </div>
            <div class="cell">
                <a href="#" id='addProject' class="expanded button">Add Project</a>
                <hr>
            </div>
            <h4>Active Projects</h4>
            <div class='cell'>
                
                <table id='projectList' class="stack">
                    <thead>
                        <th>Project</th>
                        <th>Action</th>
                    </thead>
                    <tbody></tbody>
                </table>
                <hr>
            </div>
            <h4>Inactive Projects</h4>
            <div class='cell'>
               
                <table id='archivedProjectList' class="stack">
                    <thead>
                        <th>Project</th>
                        <th>Action</th>
                    </thead>
                    <tbody></tbody>
                </table>
                
            </div>

        </div>
    </div>


<?php require_once('./_footer.php'); ?>


<script>
populateProjectTable();
populateArchivedProjectTable();
    
</script>