$(document).ready(async function() {
    setData();
    hideLoader();
});

async function setData() {
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



    var start_date = day + '/' + month + '/' + year + " 00:00:00"
    var end_date = day + '/' + month + '/' + year + " " + hours + ":" + minutes + ":00"

    fetchDeposit(start_date, end_date)
    $('#date_start').change(async function() {
        $('#tb_deposit').DataTable().destroy();
        start_date = $('#date_start').val() + ':00'
        end_date = $('#date_end').val() + ':00'
        fetchDeposit(start_date, end_date)
    })

    $('#date_end').change(async function() {
        $('#tb_deposit').DataTable().destroy();
        start_date = $('#date_start').val() + ':00'
        end_date = $('#date_end').val() + ':00'
        fetchDeposit(start_date, end_date)
    })

}

function str_pad(n) {
    return String("00" + n).slice(-2);
}

async function initDataTables(tableData, id, column) {

    $('#' + id).DataTable({
        "order": [
            [4, "desc"]
        ],
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

async function fetchDeposit(start_date, end_date) {

    el('res_start').innerHTML = start_date;
    el('res_end').innerHTML = end_date;
    let column = [{
            title: "ชื่อผู้ใช้งาน",
            className: "align-middle"
        },
        {
            title: "เครดิต",
            className: "align-middle"
        },
        {
            title: "ประเภท",
            className: "align-middle"
        },
        {
            title: "จาก",
            className: "align-middle"
        },
        {
            title: "วันที่",
            className: "align-middle"
        }
    ]
    sd = start_date.split(' ')
    ed = end_date.split(' ')
    start_date = sd[0].split('/').reverse().join('-') + ' ' + sd[1]
    end_date = ed[0].split('/').reverse().join('-') + ' ' + ed[1]

    let data = [];
    let tableData = [];
    let resWithdrawReport = await callXMLHttpRequest(`${apiPort.apiQueryTransactionManual}`, { start_date: start_date, end_date: end_date });
    if (resWithdrawReport.statusCodeText == textRespone.ok.CodeText) {
        data = resWithdrawReport.withdraw;
        let deposit = 0;
        let withdraw = 0;
        for (let i = 0; i < data.length; i++) {
            if (data[i].module == 'Deposit') {
                deposit += data[i].credit;
            } else {
                withdraw += data[i].credit;
            }

            tableData.push([
                data[i].member_username,
                formatMoney(data[i].credit),
                data[i].module == 'Deposit' ? '<span style="color:green">ฝากเงิน</span>' : '<span style="color:red">ถอนเงิน</span>',
                data[i].cr_by,
                formatDate(data[i].date) + ' ' + formatTime(data[i].date)
            ]);
        }
        let htm = '';
        el('res_deposit').innerHTML = formatMoney(deposit) + ' บาท';
        el('res_withdraw').innerHTML = formatMoney(withdraw) + ' บาท';
        if ((deposit - withdraw) >= 0) {
            htm = '<span style="color:green">(+) ' + formatMoney(deposit - withdraw) + ' บาท</span>'
        } else {
            htm = '<span style="color:red">(-) ' + formatMoney((deposit - withdraw)) + ' บาท</span>';
        }

        el('res_total').innerHTML = htm;
    } else if (resWithdrawReport.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resWithdrawReport.description,
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
    initDataTables(tableData, 'tb_deposit', column);
}