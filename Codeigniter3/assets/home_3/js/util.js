const _defaultDdlValue = [];
const importScript = {};
const el = function (id) { return document.getElementById(id); }
const en = function (name) { return document.getElementsByName(name); }

function onErrorImage(e) {
    e.src = "../../source/img/empty.jpg";
}

function isNull(param) {
    if ((param == null) || (param == undefined) || (param == '')) {
        return true;
    } else {
        return false;
    }
}

function isEmpty(param) {
    if ((param == null) || (param == undefined) || (param.length <= 0)) {
        return true;
    } else {
        return false;
    }
}

function parseJwt(token) {
    try {
        let base64Url = token.split('.')[1];
        let base64 = (base64Url.replace(/-/g, '+')).replace(/_/g, '/');
        return JSON.parse(window.atob(base64));
    } catch (e) {

    }
};

function formatMoney(n, c, d, t) {
    var c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;

    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

function callXMLHttpRequest(url, data) {
    let result;
    const xhr = new XMLHttpRequest();
    xhr.open('POST', url, false);
    xhr.setRequestHeader('Content-type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));

    xhr.send(JSON.stringify(data));
    try {
        result = JSON.parse(xhr.responseText);
    } catch (error) {
        result = { statusText: xhr.responseText };
    }
    return result;
}


function generateOptionWithDefaultValue(id, data) {
    let option = '';
    let defaultValue = 0;
    for (let element of data) {
        if (element.param_default === '1' && defaultValue === 0) {
            option += '<option value="' + element.param_value + '" selected>' + element.param_desc + '' + '</option>';
            defaultValue = 1;
            _defaultDdlValue.push({
                id: id,
                value: element.param_value
            });
        } else {
            option += '<option value="' + element.param_value + '" >' + element.param_desc + '' + '</option>';
        }
    }
    document.getElementById(id).innerHTML = option;
    $('#' + id).selectpicker('refresh');

}

function generateOption(selection, data, isPlaceholder) {
    let strHTML = '';
    if (isPlaceholder) {
        strHTML += '<option   value="" selected>--- Select ' + isPlaceholder + ' ---</option>';
    }
    for (let i = 0; i < data.length; i++) {
        strHTML += '<option  value="' + data[i].param_value + '">' + data[i].param_desc + '</option>';
    }
    document.getElementById(selection).innerHTML = strHTML;
    $('#' + selection).selectpicker('refresh');
}

function generateOptionBank(selection, data, isPlaceholder) {
    let strHTML = '';
    if (isPlaceholder) {
        strHTML += '<option   value="" selected>--- Select ' + isPlaceholder + ' ---</option>';
    }
    for (let i = 0; i < data.length; i++) {
        strHTML += '<option  value="' + data[i]._id + '">' + data[i].bank_name + '</option>';
    }
    document.getElementById(selection).innerHTML = strHTML;
    $('#' + selection).selectpicker('refresh');
}

function generateOptionเธบByIdAnName(selection, data, isPlaceholder) {
    let strHTML = '';
    if (isPlaceholder) {
        strHTML += '<option   value="" selected>--- Select ' + isPlaceholder + ' ---</option>';
    }
    for (let i = 0; i < data.length; i++) {
        strHTML += '<option  value="' + data[i]._id + '">' + data[i].name + '</option>';
    }
    document.getElementById(selection).innerHTML = strHTML;
    $('#' + selection).selectpicker('refresh');
}

function formatDateTime(d) {
    let date = new Date(d);
    let monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    let dd = date.getDate();
    let yy = date.getFullYear();
    let hh = date.getHours();
    let mm = date.getMinutes();
    let ss = date.getSeconds();
    if (dd < 10) {
        dd = '0' + dd;
    }
    if (hh < 10) {
        hh = '0' + hh;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }
    if (ss < 10) {
        ss = '0' + ss;
    }
    let result = dd + " " + monthNames[date.getMonth()] + " " + yy + " " + hh + ":" + mm + ":" + ss;
    return result;
}

function formatDate(d) {
    let date = new Date(d);
    let dd = date.getDate();
    let mmm = date.getMonth() + 1;
    let yy = date.getFullYear();
    let result = dd + "/" + mmm + "/" + yy;
    return result;
}

function formatTime(d) {
    let date = new Date(d);
    let hh = date.getHours();
    let mm = date.getMinutes();
    let ss = date.getSeconds();
    if (hh < 10) {
        hh = '0' + hh;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }
    if (ss < 10) {
        ss = '0' + ss;
    }
    let result = hh + ":" + mm + ":" + ss;
    return result;
}

const getParamInGetUrl = function () {
    const objectData = {};
    const param_array = window.location.href.split('?')[1] ? window.location.href.split('?')[1].split('&') : null;
    for (let i in param_array) {
        const x = param_array[i].split('=');
        objectData[x[0]] = x[1];
    }
    return objectData;
}

const addOverflowHiddenScrollbar = function () {
    $('body').addClass('modal-open');

}

const removeOverflowHiddenScrollbar = function () {
    $('body').removeClass('modal-open');
}

const checkAndUpdateInGame = function () {
    let getToken = sessionStorage.getItem('token');
    if (getToken) {
        let uid = parseJwt(sessionStorage.getItem('token'))._id;
        let ou_id = parseJwt(sessionStorage.getItem('token')).ou_id;
        callXMLHttpRequest(`${apiPort.apiGateWay}/playGame/updateStatusInGame`, { uid: uid, ou_id: ou_id });
    }
}



function getScript(nameScript, callback) {
    $.getScript(`${window.location.origin}/gpp/js/${nameScript}.js`, function (data, textStatus, jqxhr) {
        if (jqxhr.status == 200) {
            importScript[nameScript] = true;
            callback();
        }
    });
}

const importScriptFunc = function (name) {
    $.getScript(`${window.location.origin}/gpp/js/${name}.js`);
    return true;
}

function formatEmailWinner(el) {
    let name = el.split("@");
    let nameFormat = name[0].slice(0, -3) + '***';
    return nameFormat;
}

function getStorageImage(el) {
    let url = `https://storage.cloud.google.com/cdn-media.born2w.com/bo-dev/${el}/`
    return url
}

function getStorageImageBanner(el) {
    //banner 
    let url = `https://storage.cloud.google.com/cdn-media.born2w.com/web-dev/${el}/`
    return url
}

function formatMoneyNotDecimal(n, c, d, t) {
    var c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;

    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t);
}

function formatShowDate(date) {
    let dateCal = new Date(new Date(date).getTime() - (3600000 * 7))
    let monthName = new Array();
    monthName[0] = "January";
    monthName[1] = "February";
    monthName[2] = "March";
    monthName[3] = "April";
    monthName[4] = "May";
    monthName[5] = "June";
    monthName[6] = "July";
    monthName[7] = "August";
    monthName[8] = "September";
    monthName[9] = "October";
    monthName[10] = "November";
    monthName[11] = "December";
    let day = dateCal.getDate()
    let month = dateCal.getMonth()
    let year = dateCal.getFullYear()
    let hr = dateCal.getHours()
    let min = dateCal.getMinutes()
    let sec = dateCal.getSeconds()
    let result = `${day} ${monthName[month]} ${year} ${hr}:${min}:${sec}`
    return result
}

function setDataTable(id, url, data, column) {
    $('#' + id).DataTable({
        'pageLength': 25,
        "order": [
            [0, "desc"]
        ],
        responsive: true,
        "searching": true,
        "columnDefs": [{
            "targets": 3,
            "orderable": false
        }],
        "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
        language: {
            search: "เธเนเธเธซเธฒ",
        },
        "sortable": true,
        "ajax": {
            "url": url,
            "type": "POST",
            "datatype": "json",
            data: data
        },
        columns: column
    });
}

function setDataTableNoURL(id, data, column, l, a) {
    $('#' + id).DataTable({
        'pageLength': 20,
        "order": [
            [l, a]
        ],
        data: data,
        columns: column,
        responsive: true,
        "searching": true,
        "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
        "sortable": true,
        language: {
            search: "เธเนเธเธซเธฒ",
        },
    });
}


function generateOptionDefault(id, data) {
    let option = '';
    option += '<option value="" selected>Choose...</option>';
    data.forEach(function (element) {
        if (element.param_default === '1') {
            option += '<option value="' + element.param_value + '" selected>' + element.param_desc + '' + '</option>';
        } else {
            option += '<option value="' + element._id + '" >' + element.name +' เธเธณเธเธงเธ '+element.day + 'เธงเธฑเธ </option>';
        }
    });
    document.getElementById(id).innerHTML = option;


}

function sweetyAlert(title, text, icon, button, load) {
    swal({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: button

    }).then((result) => {
        if (result) {
            if (load) {
                window.location.href = load;
            }
        }
    })
}
const GetIp = () => {
    return new Promise(async resolve => {
        var getJSON = function (UrlIp, callback) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', UrlIp, true);
            xhr.responseType = 'json';
            xhr.onload = function () {
                var status = xhr.status;
                if (status === 200) {
                    callback(null, xhr.response);
                } else {
                    callback(status, xhr.response);
                }
            };
            xhr.send();
        };
        getJSON('https://ipapi.co/json/',
            function (err, data) {
                if (data) {
                    resolve(data);
                } else {
                    resolve(null);
                }
            });
    });
}


function callXMLHttpRequest(url, data) {
    let result;
    const xhr = new XMLHttpRequest();
    xhr.open('POST', url, false);
    xhr.setRequestHeader('Content-type', 'application/json');
    xhr.setRequestHeader('authorization', 'Bearer ' + sessionStorage.getItem('token'));

    xhr.send(JSON.stringify(data));
    try {
        result = JSON.parse(xhr.responseText);
    } catch (error) {
        result = { statusText: xhr.responseText };
    }
    return result;
}

function notuse() {
    sweetyAlert('เนเธกเนเธชเธณเน€เธฃเนเธ', 'เน€เธเธดเธ”เธเธฃเธดเธเธฒเธฃเน€เธฃเนเธงเนเธเธตเน...', 'error', '`เธขเธเน€เธฅเธดเธ`', '');
}