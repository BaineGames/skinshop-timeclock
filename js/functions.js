function doLogin(username, password) {
    var data = {
        username: username,
        password: password
    }
    console.log(data);
    $.ajax({
        type: "POST",
        url: "./api/login.php",
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
            if (data.state) {

                console.log('good do refresh');
                window.location.href = "./home.php";
            } else {
                alert("Invalid Login");
            }

        },
        failure: function (data) {
            console.log("API CALL BAD:", data);
        }
    });
}

function populateArchivedProjectTable() {

    $.ajax({
        type: "POST",
        url: "./api/getArchivedProjectList.php",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
            processArchivedProjectTable(data);
        },
        failure: function (data) {
            console.log("API CALL BAD:", data);
        }
    });

}

function populateProjectTable() {

    $.ajax({
        type: "POST",
        url: "./api/getProjectList.php",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
            processProjectTable(data);
        },
        failure: function (data) {
            console.log("API CALL BAD:", data);
        }
    });

}


function populateProjectList() {
    $.ajax({
        type: "POST",
        url: "./api/getProjectList.php",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
            processProjectList(data);
        },
        failure: function (data) {
            console.log("API CALL BAD:", data);
        }
    });
}

function processProjectTable(data) {
    console.log(data);
    $(data.data).each(function (i, v) {
        console.log(i, v);
        $('#projectList tbody').append("<tr><td>" + v.project_name + "</td><td><a href='#' class='button alert expanded deleteProject' projectId=" + v.project_id + ">Archive</a></td></tr>");
    });

    $('.deleteProject').off().on('click', function () {
        var projectId = $(this).attr('projectId');
        archiveProject(projectId);
    });

}

function processArchivedProjectTable(data) {
    console.log(data);
    $(data.data).each(function (i, v) {
        console.log(i, v);
        $('#archivedProjectList tbody').append("<tr><td>" + v.project_name + "</td><td><a href='#' class='button expanded undeleteProject' projectId=" + v.project_id + ">Unarchive</a></td></tr>");
    });

    $('.undeleteProject').off().on('click', function () {
        var projectId = $(this).attr('projectId');
        unarchiveProject(projectId);
    });

}

function archiveProject(projectId) {
    var data = {
        projectId: projectId
    }

    $.ajax({
        type: "POST",
        url: "./api/archiveProject.php",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        data: JSON.stringify(data),
        success: function (data) {
            console.log(data);
            window.location.reload();
        },
        failure: function (data) {
            console.log("API CALL BAD:", data);
        }
    });
}

function unarchiveProject(projectId) {
    var data = {
        projectId: projectId
    }

    $.ajax({
        type: "POST",
        url: "./api/unarchiveProject.php",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        data: JSON.stringify(data),
        success: function (data) {
            console.log(data);
            window.location.reload();
        },
        failure: function (data) {
            console.log("API CALL BAD:", data);
        }
    });
}

function addProject(projectName) {
    var data = {
        projectName: projectName
    }

    $.ajax({
        type: "POST",
        url: "./api/addProject.php",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        data: JSON.stringify(data),
        success: function (data) {
            window.location.reload();
        },
        failure: function (data) {
            console.log("API CALL BAD:", data);
        }
    });
}

function processProjectList(data) {
    console.log(data);
    $(data.data).each(function (i, v) {
        console.log(i, v);
        $('#projectList').append("<option value=" + v.project_id + ">" + v.project_name + "</option>");
    });

}

function clockIn(projectId, notes) {

    var data = {
        projectId: projectId,
        notes: notes
    }

    $.ajax({
        type: "POST",
        url: "./api/clockIn.php",
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
            if (data.state) {

                window.location.reload();
            } else {
                alert("Clock In Fail");
            }

        },
        failure: function (data) {
            console.log("API CALL BAD:", data);
        }
    });

}

function clockOut(projectId, notes) {

    var data = {
        projectId: projectId,
        notes: notes
    }

    $.ajax({
        type: "POST",
        url: "./api/clockOut.php",
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
            if (data.state) {

                window.location.reload();
            } else {
                alert("Clock Out Fail");
            }

        },
        failure: function (data) {
            console.log("API CALL BAD:", data);
        }
    });

}

function populateClockActivity(flag) {
    var url_add = '';
    if (flag == 'all') {
        url_add = "?showall=true";
    }
    $.ajax({
        type: "POST",
        url: "./api/getClockActivity.php" + url_add,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
            processClockActivity(data, flag);
        },
        failure: function (data) {
            console.log("API CALL BAD:", data);
        }
    });
}

function processClockActivity(data, flag) {

    $(data.data).each(function (i, v) {
        console.log(i, v);
        if (flag) {
            $('#clockActivity tbody').append("<tr><td>" + v.project_name + "</td><td>" + v.clock_in + "</td><td>" + v.clock_out + "</td><td>" + v.hours + "</td><td>" + v.in_notes + " - " + v.out_notes + "</td><td><a href='./editTimeclock.php?id=" + v.timeclock_id + "' class='button'>Edit</a> <a href='#' timeclockId="+v.timeclock_id+" class='button alert deleteTimeclock'>Delete</a></tr>");
        } else {


            $('#clockActivity tbody').append("<tr><td>" + v.project_name + "</td><td>" + v.clock_in + "</td><td>" + v.clock_out + "</td><td>" + v.hours + "</td><td>" + v.in_notes + " - " + v.out_notes + "</td></tr>");
        }
    });
    
    $('.deleteTimeclock').off().on('click',function(){
       var timeclock_id = $(this).attr('timeclockId');
        var yesorno = confirm("Are you sure you want to delete this?");
        if(yesorno){
            deleteTimeclock(timeclock_id);
        }
    });
}

function deleteTimeclock(timeclock_id){
    var data = {
        timeclock_id : timeclock_id
    };
    $.ajax({
        type: "POST",
        url: "./api/deleteTimeclock.php",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        data: JSON.stringify(data),
        success: function (data) {
            window.location.reload();
        },
        failure: function (data) {
            console.log("API CALL BAD:", data);
        }
    });
}

function runReport(startDate, endDate, withNotes) {

    var data = {
        startDate: startDate,
        endDate: endDate,
        withNotes: withNotes
    };
    $.ajax({
        type: "POST",
        url: "./api/runReport.php",
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
            processReport(data);
        },
        failure: function (data) {
            console.log("API CALL BAD:", data);
        }
    });
}

function processReport(data) {
    $('#reportData tbody').empty();
    $('#reportData tfoot').empty();
    var masterTotal = 0;
    $(data.data).each(function (i, v) {
        masterTotal += parseFloat(v.total_hours);
        $('#reportData tbody').append("<tr><td>" + v.project_name + "</td><td>" + v.clock_date + "</td><td>" + parseFloat(v.total_hours).toFixed(2) + "</td></tr>");
    });
    $('#reportData tfoot').append("<tr><td></td><td></td><td>" + masterTotal.toFixed(2) + "</td></tr>");
    $('#hoursText').text("Hours (" + masterTotal.toFixed(2) + ")");
}

function saveTimeclockEntry(timeclock_id,startDate,endDate,inNotes,outNotes){
    var data = {
        timeclock_id : timeclock_id,
        startDate: startDate,
        endDate: endDate,
        inNotes: inNotes,
        outNotes :outNotes
    };
    
    $.ajax({
        type: "POST",
        url: "./api/saveTimeclockEntry.php",
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
            window.location.href = "./edit.php";
        },
        failure: function (data) {
            console.log("API CALL BAD:", data);
        }
    });
    
}