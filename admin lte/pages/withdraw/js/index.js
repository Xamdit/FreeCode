$(document).ready(function() {
    setDataWithdraw();
    setDataWithdrawSuccess();
    setDataWithdrawUnSuccess();
    hideLoader();
});

async function initDataTables(tableData, id, column) {
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

async function setDataWithdraw() {
    let column = [{
            title: "ชื่อผู้ใช้งาน",
            className: "align-middle"
        },
        {
            title: "ชื่อ-สกุล",
            className: "align-middle"
        },
        {
            title: "เลขบัญชี",
            className: "align-middle"
        },
        {
            title: "ธนาคาร",
            className: "align-middle"
        },
        {
            title: "จำนวนเงิน",
            className: "align-middle"
        },
        {
            title: "จัดการ",
            className: "align-middle"
        },
    ]
    let data = [];
    let tableData = [];
    let resWithdraw = await callXMLHttpRequest(`${apiPort.apiQueryeWithdrawHistory}`, {});
    if (resWithdraw.statusCodeText == textRespone.ok.CodeText) {
        if (resWithdraw.withdraw) {
            data = resWithdraw.withdraw;
            for (let i = 0; i < data.length; i++) {
                tableData.push([
                    data[i].member_username,
                    data[i].name,
                    data[i].accnum,
                    data[i].bank_name,
                    formatMoneyNotDecimal(data[i].amount),
                    `<div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-success" id="auto" data-id="${data[i].id}" onclick="withdrawAuto(${data[i].tid})">
                            อนุมัติ(ถอนออโต้)
                        </button>
                        &nbsp;
                        <button type="button" class="btn btn-outline-info" id="edit" data-id="${data[i].id}" onclick="withdrawManual(${data[i].tid})">
                           อนุมัติ(โอนมือ)
                            </button>
                            &nbsp;
                        <button type="button" class="btn btn-outline-danger" id="add_powyingshup" data-id="${data[i].id}" onclick="withdrawInject(${data[i].tid})">
                         ไม่อนุมัติ
                        </button>
                    </div>`
                ]);
            }
            initDataTables(tableData, 'withdraw', column);
        } else {
            initDataTables(tableData, 'withdraw', column);
        }
    } else if (resWithdraw.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resWithdraw.description,
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
async function withdrawAuto(id) {
    let timerInterval
    Swal.fire({
        title: 'Loading...',
        html: '',
        timer: 2500,
        timerProgressBar: true,
        didOpen: async() => {
            await Swal.showLoading();
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {

            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            withdrawAutoFunc(id);
        }
    })
}


async function withdrawAutoFunc(id) {
    let resWithdraw = await callXMLHttpRequest(`${apiPort.apiWithdrawUserAuto}`, { id: id });
    if (resWithdraw.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'ถอนเงินให้ ' + resWithdraw.username + ' สำเร็จแล้ว',
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
    } else if (resWithdraw.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resWithdraw.description,
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
            text: resWithdraw.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
}

async function withdrawManual(id) {
    let timerInterval
    Swal.fire({
        title: 'Loading...',
        html: '',
        timer: 2500,
        timerProgressBar: true,
        didOpen: async() => {
            await Swal.showLoading();
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {

            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            withdrawManualFunc(id);
        }
    })
}

async function withdrawManualFunc(id) {
    let resWithdraw = await callXMLHttpRequest(`${apiPort.apiUpdateStatusWithdraw}`, { id: id });
    if (resWithdraw.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'ถอนเงินให้ ' + resWithdraw.username + ' สำเร็จแล้ว (โอนมือ)',
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
    } else if (resWithdraw.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resWithdraw.description,
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
            text: resWithdraw.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
}


async function withdrawInject(id) {
    showLoader();
    withdrawInjectFunc(id);
    hideLoader();
}

async function withdrawInjectFunc(id) {
    let resWithdraw = await callXMLHttpRequest(`${apiPort.apiUpdateUnStatusWithdraw}`, { id: id });
    if (resWithdraw.statusCodeText == textRespone.ok.CodeText) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'ยกเลิกถอนเงินให้ ' + resWithdraw.username + ' สำเร็จแล้ว',
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
    } else if (resWithdraw.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resWithdraw.description,
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
            text: resWithdraw.description,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }
}

async function setDataWithdrawSuccess() {
    let column = [{
            title: "ชื่อผู้ใช้งาน",
            className: "align-middle"
        },
        {
            title: "ชื่อ-สกุล",
            className: "align-middle"
        },
        {
            title: "เลขบัญชี",
            className: "align-middle"
        },
        {
            title: "ธนาคาร",
            className: "align-middle"
        },
        {
            title: "จำนวนเงิน",
            className: "align-middle"
        },
        {
            title: "วันเวลา",
            className: "align-middle"
        },
    ]
    let data = [];
    let tableData = [];
    let resWithdraw = await callXMLHttpRequest(`${apiPort.apiQueryWithdrawSuccess}`, {});
    if (resWithdraw.statusCodeText == textRespone.ok.CodeText) {
        if (resWithdraw.withdraw) {
            data = resWithdraw.withdraw;
            for (let i = 0; i < data.length; i++) {
                tableData.push([
                    data[i].member_username,
                    data[i].name,
                    data[i].accnum,
                    data[i].bank_name,
                    formatMoneyNotDecimal(data[i].amount),
                    formatDate(data[i].date) + ' ' + formatTime(data[i].date),
                ]);
            }
            initDataTables(tableData, 'withdraw_success', column);
        } else {
            initDataTables(tableData, 'withdraw_success', column);
        }
    } else if (resWithdraw.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resWithdraw.description,
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

async function setDataWithdrawUnSuccess() {
    let column = [{
            title: "ชื่อผู้ใช้งาน",
            className: "align-middle"
        },
        {
            title: "ชื่อ-สกุล",
            className: "align-middle"
        },
        {
            title: "เลขบัญชี",
            className: "align-middle"
        },
        {
            title: "ธนาคาร",
            className: "align-middle"
        },
        {
            title: "จำนวนเงิน",
            className: "align-middle"
        },
        {
            title: "วันเวลา",
            className: "align-middle"
        },
    ]
    let data = [];
    let tableData = [];
    let resWithdraw = await callXMLHttpRequest(`${apiPort.apiQueryWithdrawUnSuccess}`, {});
    if (resWithdraw.statusCodeText == textRespone.ok.CodeText) {
        if (resWithdraw.withdraw) {
            data = resWithdraw.withdraw;
            for (let i = 0; i < data.length; i++) {
                tableData.push([
                    data[i].member_username,
                    data[i].name,
                    data[i].accnum,
                    data[i].bank_name,
                    formatMoneyNotDecimal(data[i].amount),
                    formatDate(data[i].date) + ' ' + formatTime(data[i].date),
                ]);
            }
            initDataTables(tableData, 'withdraw_unsuccess', column);
        } else {
            initDataTables(tableData, 'withdraw_unsuccess', column);
        }
    } else if (resWithdraw.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resWithdraw.description,
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

async function checkSCBDetail() {
    el('balance3').innerHTML = 'Waiting...';
    let resWithdraw = await callXMLHttpRequest(`${apiPort.apiCheckStatusSCB}`, {});
    if (resWithdraw.statusCodeText == textRespone.ok.CodeText) {
        if (resWithdraw.name) {
            el('name_scb').innerHTML = resWithdraw.name;
        } else {
            el('name_scb').innerHTML = '-';
        }
        if (resWithdraw.accnum) {
            el('acc_scb').innerHTML = resWithdraw.accnum;
        } else {
            el('acc_scb').innerHTML = '-';
        }
        if (resWithdraw.credit) {
            el('balance3').innerHTML = 'ยอดเงินในบัญชี SCB (ฝากถอน) : <span style="color:#0cf50c;font-size:15px;">' + formatMoney(resWithdraw.credit) + ' บาท </span>';
        } else {
            el('balance3').innerHTML = '-';
        }

    } else if (resWithdraw.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resWithdraw.description,
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
        if (resWithdraw.name) {
            el('name_scb').innerHTML = resWithdraw.name;
        } else {
            el('name_scb').innerHTML = '-';
        }
        if (resWithdraw.accnum) {
            el('acc_scb').innerHTML = resWithdraw.accnum;
        } else {
            el('acc_scb').innerHTML = '-';
        }
        el('balance3').innerHTML = 'ระบบไม่สามารถเช็คยอดเงินได้ กรุณาเว้นช่วงเวลา หรือลองใหม่อีกครั้ง';

    }
    hideLoader();
    $('#balance_info').modal('show');
}

function checkSCB() {
    $('#balance_info').modal('hide');
    showLoader();
    checkSCBDetail();
}