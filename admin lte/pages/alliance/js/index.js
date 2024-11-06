$(document).ready(async function() {
    setDatAlliance();
    hideLoader();
});

let check_id = '';

var yearL = new Date().getFullYear();
var leap = (((yearL % 4 == 0) && (yearL % 100 != 0)) || (yearL % 400 == 0)) ? 2 : 3;
var date = new Date();
var day = date.getDate();
var month = str_pad(date.getMonth('m') + 1);
var year = date.getFullYear();
var hours = date.getHours();
var minutes = date.getMinutes();

$.datetimepicker.setLocale('th');
$('#date_start').datetimepicker({
    value: day + '/' + month + '/' + year + " 00:00",
    timepicker: false,
    format: 'd/m/Y H:i',
    lang: 'th',
    dayOfWeekStart: leap,
    timepicker: true
});

$('#date_end').datetimepicker({
    value: day + '/' + month + '/' + year + " " + hours + ":" + minutes,
    timepicker: false,
    format: 'd/m/Y H:i',
    lang: 'th',
    dayOfWeekStart: leap,
    timepicker: true
});
let start_date = day + '/' + month + '/' + year + " 00:00:00"
let end_date = day + '/' + month + '/' + year + " " + hours + ":" + minutes + ":00"

$('#date_start').change(async function() {
    start_date = $('#date_start').val() + ':00'
    end_date = $('#date_end').val() + ':00'
    history(check_id, start_date, end_date);
});

async function randomString(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() *
            charactersLength));
    }
    return result;
}

async function add_alliance_modal() {
    let code = randomString(6);
    el('alliance_code').value = code;
    el('alliance_username').value = '';
    el('alliance_name').value = '';
    el('alliance_percent').value = '';
    el('alliance_accnum').value = '';
    el('alliance_bankname').value = '';
    $('#add_alliance').modal('show');
}

async function initDataTables(tableData, id, column) {
    $('#' + id).DataTable({
        data: tableData,
        columns: column,
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: async function(row) {
                        var data = row.data()
                        return 'สมาชิก: ' + data[2]
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        language: {
            "lengthMenu": "แสดงข้อมูล _MENU_ แถว",
            "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
            "info": "แสดงหน้า _PAGE_ จาก _PAGES_",
            "infoEmpty": "ไม่พบข้อมูลที่ต้องการ",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": 'ค้นหา',
            "paginate": {
                "previous": "ก่อนหน้านี้",
                "next": "หน้าต่อไป"
            }
        }
    })
}

async function copyTXT(id) {
    let text = el('url_copy_' + id).value;
    if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text);
        return;
    }
    navigator.clipboard.writeText(text).then(async function() {
        toastr.success('Copy Link เรียบร้อยแล้ว');
    }, async function(err) {
        toastr.error('เกิดดข้อผิดพลาดในการ Copy Link');
    });
}

async function setDatAlliance() {
    let column = [{
            title: "ลำดับ",
            className: "align-middle text-center"
        },
        {
            title: "วันที่เข้าร่วม",
            className: "align-middle"
        },
        {
            title: "สมาชิก",
            className: "align-middle"
        },
        {
            title: "ข้อมูลสมาชิก",
            className: "align-middle"
        },
        {
            title: "ฝาก",
            className: "align-middle"
        },
        {
            title: "ถอน",
            className: "align-middle"
        },
        {
            title: "กำไร-ขาดทุน",
            className: "align-middle"
        },
        {
            title: "รายได้",
            className: "align-middle"
        },
        {
            title: "สมาชิกทั้งหมด",
            className: "align-middle"
        },
        {
            title: "ลิ้งเชิญ",
            className: "align-middle"
        },
        {
            title: "Code",
            className: "align-middle"
        },
        {
            title: "จัดการพันธมิตร",
            className: "align-middle"
        },
    ]
    let data = [];
    let tableData = [];
    let resDeopsit = await callXMLHttpRequest(`${apiPort.apiQueryAlliance}`, {});
    if (resDeopsit.statusCodeText == textRespone.ok.CodeText) {
        hideLoader();
        data = resDeopsit.data;
        for (let i = 0; i < data.length; i++) {
            tableData.push([
                (i + 1),
                formatDate(data[i].date),
                data[i].username,
                `ชื่อ: ${data[i].name}<br>
                เบอรโทร: ${data[i].username}<br>
                บัญชี: ${data[i].bank_name}<br>
                เลขบัญชี: ${data[i].accnum}<br>
                รับกิน : ${data[i].percent}%<br>
                `,
                formatMoneyNotDecimal(data[i].deposit),
                formatMoneyNotDecimal(data[i].withdraw),
                data[i].total >= 0 ? '<span style="color:green">' + formatMoneyNotDecimal(data[i].total) + '</span>' : '<span style="color:red">' + formatMoneyNotDecimal(data[i].total) + '</span>',
                data[i].receive >= 0 ? '<span style="color:green">' + formatMoneyNotDecimal(data[i].receive) + '</span>' : '<span style="color:red">' + formatMoneyNotDecimal(data[i].receive) + '</span>',
                data[i].countmember + ' คน',
                `https://${resDeopsit.name_web}.com/alliance/${data[i].code} 
                <input type="hidden" id="url_copy_${data[i].aid}" value="https://${resDeopsit.name_web}.com/alliance/${data[i].code}">
                <button type="button" class="btn btn-info btn-sm"" onclick="copyTXT(${data[i].aid})">
                        <i class="far fa-edit"></i> แก้ไข
                        </button>`,
                data[i].code,
                `<div class="btn-group" role="group">
                <button type="button" class="btn btn-info btn-sm" onclick="history('${data[i].code}','${start_date}','${end_date}')">
                <i class="fa-regular fa-address-card"></i> ประวัติ
                </button>
                &nbsp;
                    <button type="button" class="btn btn-warning btn-sm" onclick="editMember(${data[i].aid})">
                    <i class="far fa-edit"></i> แก้ไข
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-danger btn-sm" onclick="delete_member(${data[i].aid})">
                    <i class="far fa-trash-alt"></i> ลบ
                </button>
                </div>`
            ])
        }
    } else if (resDeopsit.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resDeopsit.description,
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
    initDataTables(tableData, 'logs', column);
}

async function add_alliance() {
    let code = el('alliance_code').value;
    let alliance_username = el('alliance_username').value;
    let alliance_name = el('alliance_name').value;
    let alliance_percent = el('alliance_percent').value;
    let alliance_accnum = el('alliance_accnum').value;
    let alliance_bankname = el('alliance_bankname').value;

    let data = {
        code: code,
        username: alliance_username,
        name: alliance_name,
        accnum: alliance_accnum,
        bankname: alliance_bankname,
        percent: alliance_percent,
    };

    let resAlliance = await callXMLHttpRequest(`${apiPort.apiAddAlliance}`, data);
    if (resAlliance.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'เพิ่ม พันธมิตร เรียบร้อยแล้ว',
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
    } else if (resAlliance.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resAlliance.description,
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
            text: resAlliance.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
}

async function str_pad(n) {
    return String("00" + n).slice(-2);
}



async function history(id, start_date, end_date) {
    $('.modal').modal('hide');
    el('result_alliance').style.display = 'block';
    el('detail_alliance').style.display = 'block';
    check_id = id;
    if (el('div_id').value != 0) {
        var table = $('#detail_alliance_logs').DataTable();
        table.destroy();
        var table = $('#result_alliance_logs').DataTable();
        table.destroy();
    }
    el('div_id').value = 1;




    let column = [{
            title: "ลำดับ",
            className: "align-middle text-center"
        },
        {
            title: "สมาชิก",
            className: "align-middle"
        },
        {
            title: "User UFA",
            className: "align-middle"
        },
        {
            title: "ยอดฝาก",
            className: "align-middle"
        },
        {
            title: "ยอดถอน",
            className: "align-middle"
        }
    ]
    let data = [];

    sd = start_date.split(' ')
    ed = end_date.split(' ')
    start_date = sd[0].split('/').reverse().join('-') + ' ' + sd[1]
    end_date = ed[0].split('/').reverse().join('-') + ' ' + ed[1]
    let ddd = {
        code: id,
        start_date: start_date,
        end_date: end_date
    }
    let tableData = [];
    let resDeopsit = await callXMLHttpRequest(`${apiPort.apiQueryDetailAlliance}`, ddd);
    if (resDeopsit.statusCodeText == textRespone.ok.CodeText) {
        data = resDeopsit.data;
        el('res_start').innerHTML = start_date;
        el('res_end').innerHTML = end_date;
        el('res_user').innerHTML = resDeopsit.username;
        historyResult(resDeopsit.username);
        el('res_deposit').innerHTML = formatMoney(resDeopsit.deposit);
        el('res_withdraw').innerHTML = formatMoney(resDeopsit.withdraw);
        if (resDeopsit.total >= 0) {
            el('res_total').innerHTML = '(+) ' + formatMoney(resDeopsit.total);
            el('res_total').style.color = 'green';
        } else {
            el('res_total').innerHTML = '(-) ' + formatMoney(resDeopsit.total * -1);
            el('res_total').style.color = 'red';
        }
        el('res_amount').value = resDeopsit.receive;
        if (resDeopsit.receive >= 0) {
            el('res_rev').innerHTML = '(+) ' + formatMoney(resDeopsit.receive);
            el('res_rev').style.color = 'green';
        } else {
            el('res_rev').innerHTML = '(-) ' + formatMoney(resDeopsit.receive * -1);
            el('res_rev').style.color = 'red';
        }
        for (let i = 0; i < data.length; i++) {
            tableData.push([
                (i + 1),
                data[i].username,
                data[i].usernameUFA,
                formatMoneyNotDecimal(data[i].deposit),
                formatMoneyNotDecimal(data[i].withdraw),
            ])
        }
    } else if (resDeopsit.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resDeopsit.description,
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
    initDataTables(tableData, 'detail_alliance_logs', column);
}


async function clear_credit() {
    let username = el('res_user').innerHTML;
    let amount = el('res_amount').value;


    let data = {
        username: username,
        amount: amount
    };

    let resAlliance = await callXMLHttpRequest(`${apiPort.apiAddAllianceLog}`, data);
    if (resAlliance.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'ตัดยอดเรียบร้อยแแล้ว',
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                var table = $('#result_alliance_logs').DataTable();
                table.destroy();
                historyResult(username);
            }
        });
    } else if (resAlliance.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resAlliance.description,
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
            text: resAlliance.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
}

async function historyResult(username) {

    let column = [{
            title: "ลำดับ",
            className: "align-middle text-center"
        },
        {
            title: "สมาชิก",
            className: "align-middle"
        },
        {
            title: "จำนวนเงิน",
            className: "align-middle"
        },
        {
            title: "วันเวลา",
            className: "align-middle"
        }
    ]
    let tableData = [];
    let resDeopsit = await callXMLHttpRequest(`${apiPort.apiQueryAllianceLog}`, { username: username });
    if (resDeopsit.statusCodeText == textRespone.ok.CodeText) {
        data = resDeopsit.data;
        for (let i = 0; i < data.length; i++) {
            tableData.push([
                (i + 1),
                data[i].member_username,
                data[i].amount >= 0 ? '<span style="color:green">' + formatMoneyNotDecimal(data[i].amount) + '</span>' : '<span style="color:red">' + formatMoneyNotDecimal(data[i].amount) + '</span>',
                formatDate(data[i].date) + ' ' + formatTime(data[i].date),
            ])
        }
    } else if (resDeopsit.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resDeopsit.description,
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
    initDataTables(tableData, 'result_alliance_logs', column);
}


async function editMember(id) {
    $('.modal').modal('hide');
    let resMember = await callXMLHttpRequest(`${apiPort.apiQueryAllianceByID}`, { id: id });
    if (resMember.statusCodeText == textRespone.ok.CodeText) {
        el('edit_id_member').value = resMember.data[0].id;
        el('edit_alliance_code').value = resMember.data[0].code;
        el('edit_alliance_name').value = resMember.data[0].name;
        el('edit_alliance_username').value = resMember.data[0].username;
        el('edit_alliance_percent').value = resMember.data[0].percent;
        el('edit_alliance_accnum').value = resMember.data[0].accnum;
        el('edit_alliance_bankname').value = resMember.data[0].bank_name;
    } else if (resMember.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resMember.description,
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
            text: resMember.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
    $('#edit_alliance').modal('show');
}


async function edit_alliance_modal() {
    let id = el('edit_id_member').value;
    let code = el('edit_alliance_code').value;
    let name = el('edit_alliance_name').value;
    let username = el('edit_alliance_username').value;
    let percent = el('edit_alliance_percent').value;
    let accnum = el('edit_alliance_accnum').value;
    let bank = el('edit_alliance_bankname').value;

    let data = {
        username: username,
        code: code,
        name: name,
        accnum: accnum,
        bank: bank,
        id: id,
        percent: percent
    }

    let resEditMember = await callXMLHttpRequest(`${apiPort.apiUpdateMemberAlliance}`, data);
    if (resEditMember.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'อัพเดต พันธมิตร เรียบร้อยแล้ว',
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
    } else if (resEditMember.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resEditMember.description,
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
            text: resEditMember.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
}


async function delete_member(idDelete) {
    Swal.fire({
        title: 'แจ้งเตือน',
        text: "คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#009102',
        confirmButtonText: 'Delete'
    }).then(async(result) => {
        if (result.isConfirmed) {

            let resDeleteMember = await callXMLHttpRequest(`${apiPort.apiDeleteMemberAlliance}`, { id: idDelete });
            if (resDeleteMember.statusCodeText == textRespone.ok.CodeText) {
                Swal.fire({
                    title: 'แจ้งเตือน',
                    text: 'ลบข้อมูลเรียบร้อยแล้ว',
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
            } else {
                Swal.fire({
                    title: 'แจ้งเตือน',
                    text: resDeleteMember.description,
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
    })
}