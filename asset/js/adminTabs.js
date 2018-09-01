$(".tablinks").click(function(event) {
    var id = $(this).html();
    console.log(id);
    if(id=="Active Alerts")
    {
        $("#activeAlerts").show();
        $("#inactiveAlerts").hide();
    }

    if(id=="Inactive Alerts")
    {
        $("#inactiveAlerts").show();
        $("#activeAlerts").hide();
    }

    if(id=="Active Events")
    {
        $("#activeEvents").show();
        $("#inactiveEvents").hide();
    }

    if(id=="Inactive Events")
    {
        $("#inactiveEvents").show();
        $("#activeEvents").hide();
    }

    if(id=="Active Financial Aid")
    {
        $("#activeAid").show();
        $("#inactiveAid").hide();
    }

    if(id=="Inactive Financial Aid")
    {
        $("#activeAid").hide();
        $("#inactiveAid").show();
    }

    if(id=="Active Programs")
    {
        $("#activePrograms").show();
        $("#inactivePrograms").hide();
    }

    if(id=="Inactive Programs")
    {
        $("#activePrograms").hide();
        $("#inactivePrograms").show();
    }

    if(id=="Active Partners")
    {
        $("#activePartners").show();
        $("#inactivePartners").hide();
    }

    if(id=="Inactive Partners")
    {
        $("#activePartners").hide();
        $("#inactivePartners").show();
    }

    if(id=="Active Resources")
    {
        $("#activeResources").show();
        $("#inactiveResources").hide();
    }

    if(id=="Inactive Resources")
    {
        $("#activeResources").hide();
        $("#inactiveResources").show();
    }

    if(id=="Active Staff")
    {
        $("#activeStaff").show();
        $("#inactiveStaff").hide();
    }

    if(id=="Inactive Staff")
    {
        $("#activeStaff").hide();
        $("#inactiveStaff").show();
    }

    if(id=="Active Student Work")
    {
        $("#activeStudentWork").show();
        $("#inactiveStudentWork").hide();
    }

    if(id=="Inactive Student Work")
    {
        $("#activeStudentWork").hide();
        $("#inactiveStudentWork").show();
    }

    if(id=="Active Users")
    {
        $("#activeUsers").show();
        $("#inactiveUsers").hide();
    }

    if(id=="Inactive Users")
    {
        $("#activeUsers").hide();
        $("#inactiveUsers").show();
    }
});

$(document).ready(function(event) {
    $(".tabcontent").hide();

    $("#activeAlerts").toggle();
    $("#activeEvents").toggle();
    $("#activeAid").toggle();
    $("#activePrograms").toggle();
    $("#activePartners").toggle();
    $("#activeResources").toggle();
    $("#activeStaff").toggle();
    $("#activeStudentWork").toggle();
    $("#activeUsers").toggle();
});