$(document).ready(function () {
    if ($('.time-format').length > 0) {
        $('.time-format').timepicker({
            secondStep: 1,
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false,
            format: 'HH:mm:ss',
            autoclose: true
        });
    }
    getAllParameter();
    // defaultStatus();
    defaultActive();
})
function getCurrentDatetime(data) {

    var d = new Date(data)
    month = '' + (d.getMonth() + 1);
    day = '' + d.getDate();
    year = d.getFullYear();
    hour = '' + d.getHours();
    minutes = '' + d.getMinutes();
    seconds = '' + d.getSeconds();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    if (hour.length < 2) hour = '0' + hour;
    if (minutes.length < 2) minutes = '0' + minutes;
    if (seconds.length < 2) seconds = '0' + seconds;

    var fullDate = year + "-" + month + "-" + day + " " + hour + ":" + minutes + ":" + seconds;
    return fullDate;
}

function defaultDataSearch() {

    var d = new Date()
    month = '' + (d.getMonth() + 1);
    day = '' + d.getDate();
    year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    hour = '' + d.getHours();
    minutes = '' + d.getMinutes();
    seconds = '' + d.getSeconds();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    if (hour.length < 2) hour = '0' + hour;
    if (minutes.length < 2) minutes = '0' + minutes;
    if (seconds.length < 2) seconds = '0' + seconds;

    var fullDate = year + "-" + month + "-" + day;

    $('#searchFromDate').val(fullDate);
    $('#fromTime').val("00:00:00");
    $('#searchToDate').val(fullDate);
    $('#toTime').val(hour + ":" + minutes + ":" + seconds);

}

function defaultDateOperate(data) {

    var d = new Date(data);
    month = '' + (d.getMonth() + 1);
    day = '' + d.getDate();
    year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    hour = '' + d.getHours();
    minutes = '' + d.getMinutes();
    seconds = '' + d.getSeconds();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    if (hour.length < 2) hour = '0' + hour;
    if (minutes.length < 2) minutes = '0' + minutes;
    if (seconds.length < 2) seconds = '0' + seconds;


    var fullDate = year + "-" + month + "-" + day;


    $('#billDate').val(fullDate);
    $('#billTime').val(hour + ":" + minutes + ":" + seconds);
}

function formatcurrency(number) {
    if (number) {
        number = parseFloat(number).toFixed(2);
        return number = number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    } else {
        return 0;
    }
}

//function get param from : Jackson Artyom;
//----------------------------------------------------------------------------------------
var get_all_param;

function getAllParameter() {
    var action = "getAllParameter";
    var dataForSent = { "action": action };
    // request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', ipay_ddl_master + '/parameterfnc', false);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));
    xhr.send(JSON.stringify(dataForSent));
    // response
    var res = JSON.parse(xhr.responseText);

    get_all_param = res.data;

}

var defaultStatus; //status default "New" _id;
var defaultActive; //active default "Active" _id; 

function defaultStatus(type) {
    var needle = "New";
    var statusType = type;
    for (var i = 0; i < get_all_param.length; i++) {
        if (get_all_param[i].param_desc == needle && get_all_param[i].param_name == statusType) {
            defaultStatus = get_all_param[i]._id;
        }
    }
}

function defaultActive() {
    var needle = "Active";
    for (var i = 0; i < get_all_param.length; i++) {
        if (get_all_param[i].param_desc == needle) {
            defaultActive = get_all_param[i].param_value;
        }
    }
}
