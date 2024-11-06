$(document).ready(async function() {
    setWheel();
    hideLoader();
});

async function setWheel() {
    let result = [];
    let i = 0;

    let resSettingWheel = await callXMLHttpRequest(`${apiPort.apiQueryeSettingWheel}`, {});
    if (resSettingWheel.statusCodeText == textRespone.ok.CodeText) {
        data = resSettingWheel.data;
        let slices = [];
        let htm = '';
        el('text_color').value = data[0].text_color;
        el('text_size').value = data[0].text_size;
        el('offset_text').value = data[0].offset_text;
        el('text_type').value = data[0].text_type;
        el('line_color').value = data[0].line_color;
        el('inner_color').value = data[0].inner_color;
        el('outer_color').value = data[0].outer_color;
        el('center_color').value = data[0].center_color;
        el('center_img').value = data[0].center_img;
        el('lowcredit').value = data[0].lowcredit;
        if (data[0].status == 1) {
            el('status_1').checked = true;
            el('status_0').checked = false;
        } else {
            el('status_1').checked = false;
            el('status_0').checked = true;
        }
        for (let i = 0; i < data.length - 1; i++) {
            htm += '<input type="hidden" id="id_' + (i + 1) + '" value="' + (i + 2) + '">';
            htm += '<div class="md-form">';
            htm += '<div class="row">';
            htm += '<div class="col-xs-12 col-md-1" style="text-align: center;padding: 15px;">';
            htm += '<label for="" style="text-align: center;">วงที่ ' + (i + 1) + '</label>';
            htm += ' </div>';
            htm += '<div class="col-xs-12 col-md-4">';
            htm += '<label for="" class="control-label mb-1">เครดิต</label>';
            htm += '<input type="text" class="form-control cc-name" value="' + data[(i + 1)].value + '" id="value_' + (i + 1) + '" required>';
            htm += ' </div>';
            htm += '<div class="col-xs-12 col-md-4">';
            htm += '<label for="" class="control-label mb-1">คำอธิบาย</label>';
            htm += '<input type="text" class="form-control cc-name" value="' + data[(i + 1)].description + '" id="description_' + (i + 1) + '" required></input>';
            htm += '</div>';
            htm += '<div class="col-xs-12 col-md-3">';
            htm += '<label for="" class="control-label mb-1">สีพื้นหลัง</label>';
            htm += '<input type="text" class="form-control cc-name" value="' + data[(i + 1)].color + '" id="color_' + (i + 1) + '" required></input>';
            htm += '</div>';
            htm += '</div>';
            htm += '</div>';
            htm += '<br>';

            slices[i] = {};
            slices[i].background = data[(i + 1)].color;
            slices[i].text = data[(i + 1)].value != 0 ? data[(i + 1)].value + ' เครดิต' : 'ไม่ได้เครดิต';
            slices[i].des = data[(i + 1)].des;
            slices[i].value = data[(i + 1)].value;
        }
        htm += '<button onclick="setting_wheel()" class="btn btn-lg btn-info btn-block">บันทึก</button>';
        el('set_wheel').innerHTML = htm;
        $('.wheel-horizontal').superWheel({
            slices: slices,
            text: {
                color: data[0].text_color,
                offset: 8,
                size: data[0].text_size,
                letterSpacing: 0,
                orientation: data[0].text_type,
            },
            line: {
                width: 6,
                color: data[0].line_color
            },
            outer: {
                width: 12,
                color: data[0].outer_color
            },
            inner: {
                width: 2,
                color: data[0].inner_color,
            },
            marker: {
                background: "#00BCD4"
            },
            center: {
                width: 30,
                background: data[0].center_color,
                rotate: true,
                class: "",
                image: {
                    url: data[0].center_img,
                    width: 45
                }
            },
            selector: "value"
        });
    } else if (resSettingWheel.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resSettingWheel.description,
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
            text: resSettingWheel.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
}

async function setting_w() {
    let text_color = el('text_color').value;
    let text_size = el('text_size').value;
    let offset_text = el('offset_text').value;
    let text_type = el('text_type').value;
    let line_color = el('line_color').value;
    let inner_color = el('inner_color').value;
    let outer_color = el('outer_color').value;
    let center_color = el('center_color').value;
    let center_img = el('center_img').value;
    let lowcredit = el('lowcredit').value;
    let status = 0;
    if (el('status_1').checked) {
        status = 1
    } else {
        status = 0
    }

    let data = {
        text_color: text_color,
        text_size: text_size,
        offset_text: offset_text,
        text_type: text_type,
        line_color: line_color,
        inner_color: inner_color,
        outer_color: outer_color,
        center_color: center_color,
        center_img: center_img,
        lowcredit: lowcredit,
        status: status,
    };



    let resSettingWheel = await callXMLHttpRequest(`${apiPort.apiUpdateSetting_w}`, data);
    if (resSettingWheel.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'อัพเดตวงล้อเรียบร้อยแล้ว',
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
    } else if (resSettingWheel.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resSettingWheel.description,
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
            text: resSettingWheel.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
}

async function setting_wheel() {
    let data = {
        arr: []
    };
    for (let i = 1; i <= 10; i++) {
        data.arr.push({
            tid: el('id_' + i).value,
            value: el('value_' + i).value,
            description: el('description_' + i).value,
            color: el('color_' + i).value,
        })
    }

    let resSettingWheel = await callXMLHttpRequest(`${apiPort.apiUpdateSettingWheel}`, data);
    if (resSettingWheel.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'อัพเดตวงล้อเรียบร้อยแล้ว',
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
    } else if (resSettingWheel.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resSettingWheel.description,
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
            text: resSettingWheel.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
}