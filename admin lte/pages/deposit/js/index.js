$(document).ready(async function() {
    setDataPromotionHistory();
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

async function setDataPromotionHistory() {
    let column = [{
            title: "ชื่อผู้ใช้งาน",
            className: "align-middle"
        },
        {
            title: "เลขที่บัญชี",
            className: "align-middle"
        },
        {
            title: "วันที่",
            className: "align-middle"
        },
        {
            title: "จำนวนเงิน",
            className: "align-middle"
        },
    ]
    let data = [];
    let tableData = [];
    let resDeopsit = await callXMLHttpRequest(`${apiPort.apiQueryeDepositHistory}`, {});
    if (resDeopsit.statusCodeText == textRespone.ok.CodeText) {
        data = resDeopsit.data;
        for (let i = 0; i < data.length; i++) {
            tableData.push([
                data[i].member_username,
                '<span>' + data[i].accnum + ' ' + data[i].bank_name + '</span>',
                formatDate(data[i].date) + ' ' + formatTime(data[i].date),
                data[i].amount
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

async function setData_member_ufa() {
    let column = [{
            title: "ชื่อผู้ใช้งาน",
            className: "align-middle"
        },
        {
            title: "USER UFA",
            className: "align-middle"
        },
        {
            title: "PASSWORD UFA",
            className: "align-middle"
        },
        {
            title: "จัดการ",
            className: "align-middle"
        },
    ]
    let data = [];
    let tableData = [];
    let resMember = await callXMLHttpRequest(`${apiPort.apiQueryMemberUFA}`, {});
    if (resMember.statusCodeText == textRespone.ok.CodeText) {
        data = resMember.data;
        for (let i = 0; i < data.length; i++) {
            tableData.push([
                data[i].member_username,
                data[i].username,
                data[i].password,
                `<div class="btn-group" role="group">
                <button type="button" class="btn btn-warning" id="view_credit" data-id="${data[i].username}" onclick="view_credit('${data[i].username}')">
                <i class="fa-solid fa-eye"></i> ดูเครดิต
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-success" id="credit" data-id="${data[i].id}" onclick="manage_credit_modal('${data[i].member_username}','${data[i].username}')">
                        <i class="far fa-edit"></i> จัดการเครดิต
                        </button>
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
    initDataTables(tableData, 'logs_ufa', column);
}

async function delete_member(idDelete, username) {
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

            let resDeleteMember = await callXMLHttpRequest(`${apiPort.apiDeleteMember}`, { id: idDelete, username: username });
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

async function editPowyingshup(id, play, username) {
    el('id_member_powyingshup').value = id;
    el('powyingshup_id').innerHTML = username;
    el('powyingshup_play').innerHTML = play;
    $('#edit_powyingshup').modal('show');
}

async function editMember(id) {
    let resMember = await callXMLHttpRequest(`${apiPort.apiMember}`, { id: id });
    if (resMember.statusCodeText == textRespone.ok.CodeText) {
        el('username').value = resMember.data[0].username;
        el('password').value = resMember.data[0].password;
        el('name').value = resMember.data[0].name;
        el('accnum').value = resMember.data[0].accnum;
        el('id_member').value = id;
        let option = '<option value="">เลือกธนาคาร</option>';
        for (let i = 0; i < resMember.bank.length; i++) {
            if (resMember.bank[i].bank_id == resMember.data[0].bank) {
                option += '<option value="' + resMember.bank[i].bank_id + '" selected>' + resMember.bank[i].bank_name + '</option>';
            }
            option += '<option value="' + resMember.bank[i].bank_id + '">' + resMember.bank[i].bank_name + '</option>';
        }
        el('bank').innerHTML = option;
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
    $('#edit_member').modal('show');
}

async function editMember_modal() {
    let id = el('id_member').value;
    let username = el('username').value;
    let password = el('password').value;
    let name = el('name').value;
    let accnum = el('accnum').value;
    let bank = el('bank').value;

    let data = {
        username: username,
        password: password,
        name: name,
        accnum: accnum,
        bank: bank,
        id: id
    }

    let resDeopsit = await callXMLHttpRequest(`${apiPort.apiUpdateMember}`, data);
    if (resDeopsit.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'อัพเดต สมาชิก เรียบร้อยแล้ว',
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
    } else {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resDeopsit.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
}


async function edit_powyingshup() {
    let id = el('id_member_powyingshup').value;
    let powyingshup_id = el('powyingshup_id').innerHTML;
    let powyingshup_play = el('powyingshup_play').innerHTML;
    let amount_play = el('amount_play').value;

    let total = parseInt(powyingshup_play) + parseInt(amount_play);
    let data = {
        powyingshup_id: powyingshup_id,
        powyingshup_play: parseInt(powyingshup_play),
        total: total,
        amount_play: amount_play,
        id: id
    };
    Swal.fire({
        title: 'แจ้งเตือน',
        text: "คุณต้องการเพิ่มการเล่น จำนวน " + amount_play + " ครั้ง ใช่หรือไม่?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'เพิ่มจำนวน'
    }).then(async(result) => {
        if (result.isConfirmed) {
            let resEditPowyingshup = await callXMLHttpRequest(`${apiPort.apiUpdatePlayPowyingshup}`, data);
            if (resEditPowyingshup.statusCodeText == textRespone.ok.CodeText) {
                Swal.fire({
                    title: 'แจ้งเตือน',
                    text: 'เพิ่มการเล่นเป่่ายิ้งฉุบเรียบร้อยแล้ว',
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
                    text: resEditPowyingshup.description,
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
    });
}

async function view_credit(username) {


    let resViewCredit = await callXMLHttpRequest(`${apiPort.apiViewCreditUserUFA}`, { username: username });
    if (resViewCredit.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: username,
            text: 'Credit : ' + resViewCredit.credit,
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
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
}

async function manage_credit_modal(username, usernameUFA) {
    $('.modal').modal('hide');
    el('username_credit').innerHTML = username;
    el('uernameufa_credit').innerHTML = usernameUFA;


    var table = $('#turnover_ufa').DataTable();
    table.destroy();
    let data = [];
    let tableData = [];
    let resManageCredit = await callXMLHttpRequest(`${apiPort.apiManageCredit}`, { username: usernameUFA });
    if (resManageCredit.statusCodeText == textRespone.ok.CodeText) {
        el('turnover_credit').innerHTML = formatMoneyNotDecimal(resManageCredit.turnover);
        data = resManageCredit.historyturnover;
        if (data) {
            for (let i = 0; i < data.length; i++) {
                tableData.push([
                    data[i].username,
                    data[i].turnover,
                    data[i].date,
                ])
            }
            initDataTables(tableData, 'turnover_ufa', column_turnover);
        } else {
            initDataTables([], 'turnover_ufa', column_turnover);
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
    } else {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resDeopsit.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
    $('#manage_credit').modal('show');
}

async function add_credit() {
    let username = el('username_credit').innerHTML;
    let usernameUFA = el('uernameufa_credit').innerHTML;
    let amount = el('amount_credit').value;
    let data = {
        username: username,
        usernameUFA: usernameUFA,
        amount: amount
    };
    let resManageCredit = await callXMLHttpRequest(`${apiPort.apiAddCredit}`, data);
    if (resManageCredit.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'เติมเครดิตให้กับ ' + usernameUFA + ' จำนวน : ' + amount + ' สำเร็จแล้ว',
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
    } else {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resDeopsit.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
}

async function minus_credit() {
    let username = el('username_credit').innerHTML;
    let usernameUFA = el('uernameufa_credit').innerHTML;
    let amount = el('amount_credit').value;
    let data = {
        username: username,
        usernameUFA: usernameUFA,
        amount: amount
    };
    let resViewCredit = await callXMLHttpRequest(`${apiPort.apiViewCreditUserUFA}`, { username: usernameUFA });
    let credit_split = (resViewCredit.credit).split(',');
    let credit_now = parseFloat(credit_split[0] + credit_split[1]);

    if (credit_now >= amount) {
        toastr.success('กำลังถอนเครดิต กรุณารอสักครู่');
        let resManageCredit = await callXMLHttpRequest(`${apiPort.apiMinusCredit}`, data);
        if (resManageCredit.statusCodeText == textRespone.ok.CodeText) {
            Swal.fire({
                title: 'แจ้งเตือน',
                text: 'ถอนเครดิตให้กับ ' + usernameUFA + ' จำนวน : ' + amount + ' สำเร็จแล้ว',
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
                text: resManageCredit.description,
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
    } else {
        toastr.error('ไม่สามารถถอนเครดิตได้');
    }

}

async function checkNumCredit() {
    let credit = parseInt(el('amount_credit').value);
    if (credit >= 0) {} else {
        document.getElementById('amount_credit').value = 0;
    }

}