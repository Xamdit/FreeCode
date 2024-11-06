$(document).ready(async function() {
    setData();
    hideLoader();
});

async function setData() {
    let resSettingPowyingshup = await callXMLHttpRequest(`${apiPort.apiQuerySettingPowYingShup}`, {});
    if (resSettingPowyingshup.statusCodeText == textRespone.ok.CodeText) {
        el('credit_low').value = resSettingPowyingshup.data[0].credit_low;
        el('credit_high').value = resSettingPowyingshup.data[0].credit_high;
        el('credit_prize').value = resSettingPowyingshup.data[0].credit_prize;
        el('round').value = resSettingPowyingshup.data[0].round;
        el('deposit').value = resSettingPowyingshup.data[0].deposit;
        el('play').value = resSettingPowyingshup.data[0].play;
        el('day').value = resSettingPowyingshup.data[0].day;
        if (resSettingPowyingshup.data[0].status == 1) {
            el('status_1').checked = true;
            el('status_0').checked = false;
        } else {
            el('status_0').checked = true;
            el('status_1').checked = false;
        }
    } else if (resSettingPowyingshup.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resSettingPowyingshup.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                sessionStorage.removeItem('token');
                sessionStorage.removeItem('category');
                window.location.href = '../../auth_login/login.html';
            }
        });
    }
}

async function save_setting() {
    let credit_low = el('credit_low').value;
    let credit_high = el('credit_high').value;
    let credit_prize = el('credit_prize').value;
    let round = el('round').value;
    let deposit = el('deposit').value;
    let play = el('play').value;
    let day = el('day').value;
    let status = 0;
    if (el('status_1').checked) {
        status = 1
    } else {
        status = 0
    }

    let data = {
        credit_low: credit_low,
        credit_high: credit_high,
        credit_prize: credit_prize,
        round: round,
        deposit: deposit,
        play: play,
        day: day,
        status: status,
    };



    let resSettingPowyingshup = await callXMLHttpRequest(`${apiPort.apiUpdatePowYingShup}`, data);
    if (resSettingPowyingshup.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'อัพเดตเป่ายิ้งฉุบเรียบร้อยแล้ว',
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location.reload();
            }
        });
    } else if (resSettingPowyingshup.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resSettingPowyingshup.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                sessionStorage.removeItem('token');
                sessionStorage.removeItem('category');
                window.location.href = '../../auth_login/login.html';
            }
        });
    } else {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resSettingPowyingshup.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
}