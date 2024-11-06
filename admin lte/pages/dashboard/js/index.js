$(document).ready(async function() {
    checkAdminID();
    setData();
});


async function setData() {
    let resDashboard = await callXMLHttpRequest(`${apiPort.apiDashboard}`, {});

    if (resDashboard.statusCodeText == textRespone.ok.CodeText) {
        hideLoader();
        el('dashboard_credit_ufa').innerHTML = resDashboard.data.lblaCredit;
        el('dashboard_member_ufa').innerHTML = resDashboard.data.lblaTotalMemberCount;
        el('dashboard_deposit_all').innerHTML = formatMoneyNotDecimal(resDashboard.depositall) + ' บาท';
        el('dashboard_withdraw_all').innerHTML = formatMoneyNotDecimal(resDashboard.withdrawall) + ' บาท';

        el('deposit_summary').innerHTML = formatMoneyNotDecimal(resDashboard.depositall) + ' บาท';
        el('withdraw_summary').innerHTML = formatMoneyNotDecimal(resDashboard.withdrawall) + ' บาท';

        let total = resDashboard.depositall - resDashboard.withdrawall;
        let txt_total = '';
        if (total >= 0) {
            txt_total = '<font color="green">' + formatMoneyNotDecimal(total) + '</font> บาท';
        } else {
            txt_total = '<font color="red">' + formatMoneyNotDecimal(total) + '</font> บาท';
        }
        el('total_summary').innerHTML = txt_total;

        let total_sum = resDashboard.depositall + resDashboard.withdrawall;
        let total_deposit = (resDashboard.depositall / total_sum) * 100;
        let total_withdraw = (resDashboard.withdrawall / total_sum) * 100;

        el("progress_deposit").ariaValueNow = total_deposit;
        el('progress_deposit').style = 'width:' + total_deposit + '%';
        el('progress_deposit').innerHTML = parseInt(total_deposit) + '%';
        el("progress_withdraw").ariaValueNow = total_withdraw;
        el('progress_withdraw').style = 'width:' + total_withdraw + '%';
        el('progress_withdraw').innerHTML = parseInt(total_withdraw) + '%';
    } else if (resDashboard.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resDashboard.description,
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

    let resSetting = await callXMLHttpRequest(`${apiPort.apiSettingDashboard}`, {});
    if (resSetting.statusCodeText == textRespone.ok.CodeText) {
        el('line_id').value = resSetting.line;
        el('name_web').value = resSetting.name_web;
        el('d_limit').value = resSetting.d_limit;
        el('w_limit').value = resSetting.w_limit;
        el('aff_d').value = resSetting.aff_d;
        el('aff_m').value = resSetting.aff_m;
        el('token_line').value = resSetting.token_line;
        el('token_line_game').value = resSetting.token_line_game;
        el('token_line_depo').value = resSetting.token_line_depo;
        el('token_line_with').value = resSetting.token_line_with;
        el('credit_min').value = resSetting.credit_min;
        el('credit_max').value = resSetting.credit_max;
        el('credit_limit').value = resSetting.credit_limit;
        if (member_nav.id === 1) {
            el('agent_ufa').value = resSetting.user_ufa;
            el('agent_pass').value = resSetting.pass_ufa;
        }

        if (resSetting.auto_status == 1) {
            el('status_1').checked = true;
            el('status_0').checked = false;
        } else {
            el('status_1').checked = false;
            el('status_0').checked = true;
        }
    } else if (resSetting.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resSetting.description,
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
            text: resSetting.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }

}

async function Loading() {
    let timerInterval
    Swal.fire({
        title: 'Loading...',
        html: '',
        allowOutsideClick: false,
        timerProgressBar: true,
        didOpen: async() => {
            Swal.showLoading();
            let sss = await setData();
            if (sss) {
                Swal.close();
            }
        },
    });
}



$('#edit_general_setting').on('click', async function() {

    let line_id = el('line_id').value;
    let name_web = el('name_web').value;
    let d_limit = el('d_limit').value;
    let w_limit = el('w_limit').value;
    let aff_d = el('aff_d').value;
    let aff_m = el('aff_m').value;

    let data = {
        line: line_id,
        name_web: name_web,
        d_limit: d_limit,
        w_limit: w_limit,
        aff_d: aff_d,
        aff_m: aff_m,
    }

    let resEditGeneralSetting = await callXMLHttpRequest(`${apiPort.apiUpdateGeneralSetting}`, data);
    if (resEditGeneralSetting.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'อัพเดต General Setting เรียบร้อยแล้ว',
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
    } else if (resSetting.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resSetting.description,
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
            text: resSetting.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
});


$('#edit_auto_setting').on('click', async function() {

    let credit_min = el('credit_min').value;
    let credit_max = el('credit_max').value;
    let credit_limit = el('credit_limit').value;
    let status_1 = el('status_1');
    let status_0 = el('status_0');

    let status = 0;
    if (status_1.checked) {
        status = 1;
    } else if (status_0.checked) {
        status = 0;
    }

    let data = {
        credit_min: credit_min,
        credit_max: credit_max,
        credit_limit: credit_limit,
        status: status
    }

    let resEditGeneralSetting = await callXMLHttpRequest(`${apiPort.apiUpdateAutoSetting}`, data);
    if (resEditGeneralSetting.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'อัพเดต ระบบถอนออโต้ เรียบร้อยแล้ว',
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
    } else if (resSetting.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resSetting.description,
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
            text: resSetting.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
});

$('#edit_notify_setting').on('click', async function() {

    let token_line = el('token_line').value;
    let token_line_game = el('token_line_game').value;
    let token_line_depo = el('token_line_depo').value;
    let token_line_with = el('token_line_with').value;

    let data = {
        token_line: token_line,
        token_line_game: token_line_game,
        token_line_depo: token_line_depo,
        token_line_with: token_line_with
    }

    let resEditGeneralSetting = await callXMLHttpRequest(`${apiPort.apiUpdateNotifySetting}`, data);
    if (resEditGeneralSetting.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'อัพเดต Token Notify เรียบร้อยแล้ว',
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
    } else if (resSetting.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resSetting.description,
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
            text: resSetting.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
});

function checkAdminID() {
    if (member_nav.id === 1) {
        $('#adminscb').html(`<div class="card-header">
		<h3 class="card-title">ตั้งค่า device SCB (เฉพาะผู้มีสิทธิ)</h3>
	</div>
	<div class="card-body">
		<p class="muted mb-3 text-red">*เป็นการบันทึกทางเดียวดึงมาแสดงไม่ได้ หากกดบันทึกซ้ำจะเป็นการเพิ่มข้อมูลใหม่</p>
		<div class="form-group">
			<label for="exampleInputEmail1">เลขที่บัญชี</label>
			<input type="text" class="form-control" id="acc_num" maxlength="13">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Device ID.</label>
			<input type="password" class="form-control" id="deviceId" maxlength="50">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">ชื่อบัญชี</label>
			<input type="text" class="form-control" id="acc_name">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Pin.</label>
			<input type="password" class="form-control" id="acc_pin" maxlength="6">
		</div>
		<div class="card-footer" style="padding:0px;">
			<button id="edit_scb_device" class="btn btn-primary" onclick="editScbDevice()" style="width: 100%;">บันทึก</button>
		</div>
	</div>`);
        $('#ufaform').html(`<div class="card-header">
		<h3 class="card-title">Setting Ufa Agent</h3>
	</div>
	<div class="card-body">
		<div class="form-group" autocomplete="off">
			<label>Username Agent</label>
			<input type="text" class="form-control" autocomplete="off" id="agent_ufa">
		</div>
		<div class="form-group">
			<label>Password Agent</label>
			<input type="password" class="form-control" autocomplete="off" id="agent_pass">
		</div>
		<div class="card-footer" style="padding:0px;">
			<button id="edit_agent_ufa" class="btn btn-primary" onclick="editAgentUfa()" style="width: 100%;">บันทึก</button>
		</div>
	</div>`);
    }
}

async function editScbDevice() {
    let acc_num = $('#acc_num').val();
    let acc_name = $('#acc_name').val();
    let deviceId = $('#deviceId').val();
    let acc_pin = $('#acc_pin').val();
    if (acc_num === '' || acc_name === '' || deviceId === '' || acc_pin === '') {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: `กรุณากรอกข้อมูลให้ครบถ้วน`,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
        return;
    }
    let data = {
        acc_num: acc_num,
        acc_name: acc_name,
        deviceId: deviceId,
        acc_pin: acc_pin
    }
    showLoader();
    let resEditDeviceScb = await callXMLHttpRequest(`${apiPort.apiUpdateDeviceScb}`, data);
    if (resEditDeviceScb.statusCodeText == textRespone.ok.CodeText) {
        hideLoader();
        Swal.fire({
            title: 'แจ้งเตือน',
            text: `${resEditDeviceScb.data}`,
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.reload();
        });
    }
}

async function editAgentUfa() {
    let agent_ufa = $('#agent_ufa').val();
    let agent_pass = $('#agent_pass').val();
    if (agent_ufa === '' || agent_pass === '' || agent_ufa.length < 4 || agent_pass.length < 4) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: `กรุณากรอกข้อมูลให้ครบถ้วน`,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
        return;
    }
    let data = {
        acc_ufa: agent_ufa,
        ufa_pass: agent_pass,
    }
    showLoader();
    let resEditUfaAcc = await callXMLHttpRequest(`${apiPort.apiUpdateUfaAcc}`, data);
    if (resEditUfaAcc.statusCodeText == textRespone.ok.CodeText) {
        hideLoader();
        Swal.fire({
            title: 'แจ้งเตือน',
            text: `${resEditUfaAcc.data}`,
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.reload();
        });
    }

}