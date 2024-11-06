$(document).ready(async function() {
    setDataResult();
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

async function setDataResult() {
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
    let resResults = await callXMLHttpRequest(`${apiPort.apiQueryResult}`, {});
    if (resResults.statusCodeText == textRespone.ok.CodeText) {

        el('deposit_today').innerHTML = formatMoneyNotDecimal(resResults.deposit_today) + ' บาท';
        el('withdraw_today').innerHTML = formatMoneyNotDecimal(resResults.withdraw_today) + ' บาท';
        if (resResults.total_today >= 0) {
            el('total_today').innerHTML = '<font color="green">' + formatMoneyNotDecimal(resResults.total_today) + '</font> บาท';
        } else {
            el('total_today').innerHTML = '<font color="red">' + formatMoneyNotDecimal(resResults.total_today) + '</font> บาท';
        }

        el('deposit_month').innerHTML = formatMoneyNotDecimal(resResults.deposit_month) + ' บาท';
        el('withdraw_month').innerHTML = formatMoneyNotDecimal(resResults.withdraw_month) + ' บาท';
        if (resResults.total_month >= 0) {
            el('total_month').innerHTML = '<font color="green">' + formatMoneyNotDecimal(resResults.total_month) + '</font> บาท';
        } else {
            el('total_month').innerHTML = '<font color="red">' + formatMoneyNotDecimal(resResults.total_month) + '</font> บาท';
        }

        el('deposit_year').innerHTML = formatMoneyNotDecimal(resResults.deposit_year) + ' บาท';
        el('withdraw_year').innerHTML = formatMoneyNotDecimal(resResults.withdraw_year) + ' บาท';
        if (resResults.total_year >= 0) {
            el('total_year').innerHTML = '<font color="green">' + formatMoneyNotDecimal(resResults.total_year) + '</font> บาท';
        } else {
            el('total_year').innerHTML = '<font color="red">' + formatMoneyNotDecimal(resResults.total_year) + '</font> บาท';
        }


        let htm_last_deposit = '';

        for (let i = 0; i < resResults.last_deposit.length; i++) {
            htm_last_deposit += '<tr>';
            htm_last_deposit += '<td style="text-align:center;">' + resResults.last_deposit[i].member_username + '</td>';
            htm_last_deposit += '<td style="text-align:center;">' + formatDate(resResults.last_deposit[i].date) + ' ' + formatTime(resResults.last_deposit[i].date) + '</td>';
            htm_last_deposit += '<td style="text-align:center;">' + formatMoneyNotDecimal(resResults.top_deposit[i].amount) + '</td>';
            htm_last_deposit += '</tr>';
        }
        el('last_deposit').innerHTML = htm_last_deposit;


        let htm_top_deposit = '';

        for (let i = 0; i < resResults.top_deposit.length; i++) {
            htm_top_deposit += '<tr>';
            htm_top_deposit += '<td style="text-align:center;">' + resResults.top_deposit[i].member_username + '</td>';
            htm_top_deposit += '<td style="text-align:center;">' + formatMoneyNotDecimal(resResults.top_deposit[i].amount) + '</td>';
            htm_last_deposit += '</tr>';
        }
        el('top_deposit').innerHTML = htm_top_deposit;


        let htm_top_withdraw = '';

        for (let i = 0; i < resResults.top_withdraw.length; i++) {
            htm_top_withdraw += '<tr>';
            htm_top_withdraw += '<td style="text-align:center;">' + resResults.top_withdraw[i].member_username + '</td>';
            htm_top_withdraw += '<td style="text-align:center;">' + formatMoneyNotDecimal(resResults.top_withdraw[i].amount) + '</td>';
            htm_top_withdraw += '</tr>';
        }
        el('top_withdraw').innerHTML = htm_top_withdraw;

    } else if (resResults.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resResults.description,
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