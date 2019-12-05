$(document).foundation()



$(document).ready(function () {
    $('#loginBtn').off().on('click', function () {
        var username = $('#username').val();
        var password = $('#password').val();
        doLogin(username,password);
    });
    
    
    $('#clockIn').off().on('click',function(){
        var projectId = $('#projectList').val();
       var notes = $('#timeclockNotes').val(); 
        
        clockIn(projectId,notes);
    });
    
    $('#clockOut').off().on('click',function(){
        var projectId = $('#projectList').val();
        var notes = $('#timeclockNotes').val(); 

        clockOut(projectId,notes);
    });
    
    $('#addProject').off().on('click',function(){
        var projectName = $('#projectName').val();
        
        addProject(projectName);
    });
    
    $('#runReport').off().on('click',function(){
       var startDate = $('#startDate').val();
        var endDate = $("#endDate").val();
        var withNotes = $("#withNotes").is(':checked');
        
        runReport(startDate,endDate,withNotes);
    });
    
    $('#saveTimeclock').off().on('click',function(){
        var timeclock_id = $('#timeclock_id').val();
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        var inNotes = $('#inNotes').val();
        var outNotes = $('#outNotes').val();
        
        saveTimeclockEntry(timeclock_id,startDate,endDate,inNotes,outNotes);
    });
});