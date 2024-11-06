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
        value: day + '/' + month + '/' + year,
        timepicker: false,
        format: 'd/m/Y',
        lang: 'th',
        dayOfWeekStart: leap,
        timepicker: true
    });

    $('#date_end').datetimepicker({
        value: day + '/' + month + '/' + year,
        timepicker: false,
        format: 'd/m/Y',
        lang: 'th',
        dayOfWeekStart: leap,
        timepicker: true
    });



    var start_date = day + '/' + month + '/' + year
    var end_date = day + '/' + month + '/' + year

    fetchDeposit(start_date, end_date, '')
    $('#date_start').change(async function() {

    })
}

function str_pad(n) {
    return String("00" + n).slice(-2);
}

async function initDataTables(tableData, id, column) {

    $('#' + id).DataTable({
        "order": [
            [2, "desc"]
        ],
        data: tableData,
        columns: column,
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: async function(row) {
                        var data = row.data()
                        return 'ผู้ใช้งาน: ' + data[0]
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

async function fetchDeposit(start_date, end_date, username) {

    let column = [{
            title: "ชื่อผู้ใช้งาน",
            className: "align-middle"
        },
        {
            title: "ยอดเทิร์น",
            className: "align-middle"
        },
        {
            title: "วันที่",
            className: "align-middle"
        }
    ]
    sd = start_date.split(' ')
    ed = end_date.split(' ')
    start_date = sd[0].split('/').join('-')
    end_date = ed[0].split('/').join('-')

    el('res_start').innerHTML = start_date;
    el('res_end').innerHTML = end_date;
    el('res_turnover').innerHTML = 0;

    let data = [];
    let tableData = [];
    let resTurnover = await callXMLHttpRequest(`${apiPort.apiQueryTurnover}`, { start: start_date, end: end_date, username: username });
    if (resTurnover.statusCodeText == textRespone.ok.CodeText) {
        data = resTurnover.data;
        for (let i = 0; i < data.length; i++) {
            tableData.push([
                data[i].username,
                data[i].turnover,
                data[i].date
            ])
        }
        el('res_start').innerHTML = start_date;
        el('res_end').innerHTML = end_date;
        el('res_turnover').innerHTML = resTurnover.turnover;
    } else if (resTurnover.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resTurnover.description,
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


async function searchData() {
    $('#tb_deposit').DataTable().destroy();
    start_date = $('#date_start').val()
    end_date = $('#date_end').val()
    let username = el('username').value;
    fetchDeposit(start_date, end_date, username);
}