$(document).ready(async function() {
    setData_member();
    hideLoader();
});

function initDataTables(tableData, id, column) {

    $('#' + id).DataTable({
        data: tableData,
        columns: column,
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: async function(row) {
                        var data = row.data()
                        return 'ผู้ใช้งาน: ' + data[1]
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

async function add_member() {
    el('add_username').value = '';
    el('add_password').value = '';
    el('member').checked = true;
    el('promotion').checked = true;
    el('promotion_history').checked = true;
    el('withdraw').checked = true;
    el('Deposit').checked = true;
    el('result').checked = false;
    el('report_deposit').checked = false;
    el('report_withdraw').checked = false;
    el('report_finance').checked = false;
    el('staff').checked = false;
    el('staff_history').checked = false;
    el('setting_wheel').checked = false;
    el('report_wheelspin').checked = true;
    el('setting_powyingshup').checked = true;
    el('report_powyingshup').checked = true;
    $('#add_member').modal('show');


}

async function addMember_modal() {
    let username = el('add_username').value;
    let password = el('add_password').value;
    let member = el('member').checked;
    let promotion = el('promotion').checked;
    let promotion_history = el('promotion_history').checked;
    let withdraw = el('withdraw').checked;
    let Deposit = el('Deposit').checked;
    let result = el('result').checked;
    let report_deposit = el('report_deposit').checked;
    let report_withdraw = el('report_withdraw').checked;
    let report_finance = el('report_finance').checked;
    let report_turnover = el('report_turnover').checked;
    let staff = el('staff').checked;
    let staff_history = el('staff_history').checked;
    let setting_wheel = el('setting_wheel').checked;
    let report_wheelspin = el('report_wheelspin').checked;
    let setting_powyingshup = el('setting_powyingshup').checked;
    let report_powyingshup = el('report_powyingshup').checked;

    let category = "";


    if (member) {
        category += ",จัดการสมาชิก";
    }


    if (promotion) {
        category += ",โปรโมชั่น";
    }

    if (promotion_history) {
        category += ",ประวัติรับโปรโมชั่น";
    }

    if (withdraw) {
        category += ",ถอนเงิน";
    }

    if (Deposit) {
        category += ",ฝากเงิน";
    }

    if (result) {
        category += ",รายงานผล";
    }

    if (report_deposit) {
        category += ",รายงานการฝากเงิน";
    }

    if (report_withdraw) {
        category += ",รายงานการถอนเงิน";
    }

    if (report_finance) {
        category += ",รายงานการเงิน";
    }
    if (report_turnover) {
        category += ",รายงานยอดเทิร์น";
    }

    if (staff) {
        category += ",จัดการพนักงาน";
    }

    if (staff_history) {
        category += ",ประวัติของพนักงาน";
    }

    if (setting_wheel) {
        category += ",ตั้งค่าวงล้อ";
    }

    if (report_wheelspin) {
        category += ",รายงานการสุ่มวงล้อ";
    }

    if (setting_powyingshup) {
        category += ",ตั้งค่าเป่ายิ้งฉุบ";
    }

    if (report_powyingshup) {
        category += ",รายงานการเล่นเป่ายิ้งฉุบ";
    }

    let data = {
        username: username,
        password: password,
        category: category

    };
    let resEditMember = await callXMLHttpRequest(`${apiPort.apiAddStaff}`, data);
    if (resEditMember.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'เพิ่ม Staff เรียบร้อยแล้ว',
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

async function edit_member(id) {
    $('#edit_member').modal('show');
    let category = [];


    let resEditMember = await callXMLHttpRequest(`${apiPort.apiQueryStaffByID}`, { id: id });
    el('edit_username').value = resEditMember.data[0].username;
    el('edit_password').value = resEditMember.data[0].password;
    el('id_member_edit').value = id;
    let split_category = (resEditMember.data[0].category).split(',');
    for (let i = 0; i < split_category.length; i++) {
        if (split_category[i] != '') {
            category.push(split_category[i]);
        }
    }

    if ((category.indexOf('จัดการสมาชิก') != -1)) {
        el('member_edit').checked = true;
    } else {
        el('member_edit').checked = false;
    }

    if ((category.indexOf('โปรโมชั่น') != -1)) {
        el('promotion_edit').checked = true;
    } else {
        el('promotion_edit').checked = false;
    }

    if ((category.indexOf('ประวัติรับโปรโมชั่น') != -1)) {
        el('promotion_history_edit').checked = true;
    } else {
        el('promotion_history_edit').checked = false;
    }

    if ((category.indexOf('ถอนเงิน') != -1)) {
        el('withdraw_edit').checked = true;
    } else {
        el('withdraw_edit').checked = false;
    }

    if ((category.indexOf('ฝากเงิน') != -1)) {
        el('Deposit_edit').checked = true;
    } else {
        el('Deposit_edit').checked = false;
    }

    if ((category.indexOf('รายงานผล') != -1)) {
        el('result_edit').checked = true;
    } else {
        el('result_edit').checked = false;
    }

    if ((category.indexOf('รายงานฝากเงิน') != -1)) {
        el('report_deposit_edit').checked = true;
    } else {
        el('report_deposit_edit').checked = false;
    }

    if ((category.indexOf('รายงานถอนเงิน') != -1)) {
        el('report_withdraw_edit').checked = true;
    } else {
        el('report_withdraw_edit').checked = false;
    }

    if ((category.indexOf('รายงานการเงิน') != -1)) {
        el('report_finance_edit').checked = true;
    } else {
        el('report_finance_edit').checked = false;
    }

    if ((category.indexOf('รายงานยอดเทิร์น') != -1)) {
        el('report_turnover_edit').checked = true;
    } else {
        el('report_turnover_edit').checked = false;
    }

    if ((category.indexOf('จัดการพนักงาน') != -1)) {
        el('staff_edit').checked = true;
    } else {
        el('staff_edit').checked = false;
    }

    if ((category.indexOf('ประวัติของพนักงาน') != -1)) {
        el('staff_history_edit').checked = true;
    } else {
        el('staff_history_edit').checked = false;
    }

    if ((category.indexOf('ตั้งค่าวงล้อ') != -1)) {
        el('setting_wheel_edit').checked = true;
    } else {
        el('setting_wheel_edit').checked = false;
    }

    if ((category.indexOf('รายงานการสุ่มวงล้อ') != -1)) {
        el('report_wheelspin_edit').checked = true;
    } else {
        el('report_wheelspin_edit').checked = false;
    }

    if ((category.indexOf('ตั้งค่าเป่ายิ้งฉุบ') != -1)) {
        el('setting_powyingshup_edit').checked = true;
    } else {
        el('setting_powyingshup_edit').checked = false;
    }

    if ((category.indexOf('รายงานการเล่นเป่ายิ้งฉุบ') != -1)) {
        el('report_powyingshup_edit').checked = true;
    } else {
        el('report_powyingshup_edit').checked = false;
    }
}

async function edit_member_model() {
    let id = el('id_member_edit').value;
    let username = el('edit_username').value;
    let password = el('edit_password').value;
    let member = el('member_edit').checked;
    let promotion = el('promotion_edit').checked;
    let promotion_history = el('promotion_history_edit').checked;
    let withdraw = el('withdraw_edit').checked;
    let Deposit = el('Deposit_edit').checked;
    let result = el('result_edit').checked;
    let report_deposit = el('report_deposit_edit').checked;
    let report_withdraw = el('report_withdraw_edit').checked;
    let report_finance = el('report_finance_edit').checked;
    let report_turnover = el('report_turnover_edit').checked;
    let staff = el('staff_edit').checked;
    let staff_history = el('staff_history_edit').checked;
    let setting_wheel = el('setting_wheel_edit').checked;
    let report_wheelspin = el('report_wheelspin_edit').checked;
    let setting_powyingshup = el('setting_powyingshup_edit').checked;
    let report_powyingshup = el('report_powyingshup_edit').checked;

    let category = "";


    if (member) {
        category += ",จัดการสมาชิก";
    }


    if (promotion) {
        category += ",โปรโมชั่น";
    }

    if (promotion_history) {
        category += ",ประวัติรับโปรโมชั่น";
    }

    if (withdraw) {
        category += ",ถอนเงิน";
    }

    if (Deposit) {
        category += ",ฝากเงิน";
    }

    if (result) {
        category += ",รายงานผล";
    }

    if (report_deposit) {
        category += ",รายงานการฝากเงิน";
    }

    if (report_withdraw) {
        category += ",รายงานการถอนเงิน";
    }

    if (report_finance) {
        category += ",รายงานการเงิน";
    }
    if (report_turnover) {
        category += ",รายงานยอดเทิร์น";
    }

    if (staff) {
        category += ",จัดการพนักงาน";
    }

    if (staff_history) {
        category += ",ประวัติของพนักงาน";
    }

    if (setting_wheel) {
        category += ",ตั้งค่าวงล้อ";
    }

    if (report_wheelspin) {
        category += ",รายงานการสุ่มวงล้อ";
    }

    if (setting_powyingshup) {
        category += ",ตั้งค่าเป่ายิ้งฉุบ";
    }

    if (report_powyingshup) {
        category += ",รายงานการเล่นเป่ายิ้งฉุบ";
    }

    let data = {
        id: id,
        username: username,
        password: password,
        category: category
    };


    let resEditMember = await callXMLHttpRequest(`${apiPort.apiUpdateStaff}`, data);
    if (resEditMember.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'แก้ไข Staff เรียบร้อยแล้ว',
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











async function setData_member() {
    let column = [{
            title: "ชื่อผู้ใช้งาน",
            className: "align-middle text-center"
        },
        {
            title: "การใช้งาน",
            className: "align-middle text-center"
        },
        {
            title: "จัดการ",
            className: "align-middle text-center"
        }
    ]
    let data = [];
    let tableData = [];
    let resMember = await callXMLHttpRequest(`${apiPort.apiQueryStaff}`, {});
    if (resMember.statusCodeText == textRespone.ok.CodeText) {
        data = resMember.data;
        for (let i = 0; i < data.length; i++) {
            tableData.push([
                data[i].username,
                data[i].category,
                `<div class="btn-group" role="group">
                <a href="#" onclick="deleteStaff(${data[i].id})" class="btn btn-outline-danger btn-lg waves-effect waves-light"><i class="fas fa-trash-alt"></i></a>
                    &nbsp;
                    <a href="#" onclick="edit_member(${data[i].id})" class="btn btn-outline-success btn-lg waves-effect waves-light"><i class="fas fa-edit"></i></a>
                </div>`
            ])
        }

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
    }
    initDataTables(tableData, 'logs', column);
}

async function deleteStaff(id) {
    Swal.fire({
        title: 'แจ้งเตือน',
        text: 'คุณต้องการจะลบ Staff คนนี้ใช่หรือไม่?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete'
    }).then(async(result) => {
        if (result.value) {
            let resEditMember = await callXMLHttpRequest(`${apiPort.apiDeleteStaff}`, { id: id });
            if (resEditMember.statusCodeText == textRespone.ok.CodeText) {
                Swal.fire({
                    title: 'แจ้งเตือน',
                    text: 'ลบ Staff เรียบร้อยแล้ว',
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
    });
}