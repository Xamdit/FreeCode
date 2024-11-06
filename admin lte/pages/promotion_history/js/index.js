$(document).ready(async function() {
    setDataPromotionHistory();
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

async function setDataPromotionHistory() {
    let column = [{
            title: "username",
            className: "align-middle"
        },
        {
            title: "จำนวนเงินที่รับ",
            className: "align-middle"
        },
        {
            title: "จำนวนเทรินที่ต้องทำ",
            className: "align-middle"
        },
        {
            title: "วันเวลา",
            className: "align-middle"
        },
        {
            title: "ชื่อโปรโมชั่น",
            className: "align-middle"
        },
    ]
    let data = [];
    let tableData = [];
    let resPromotionHistory = await callXMLHttpRequest(`${apiPort.apiQueryePromotionHistory}`, {});
    if (resPromotionHistory.statusCodeText == textRespone.ok.CodeText) {
        data = resPromotionHistory.data;
        for (let i = 0; i < data.length; i++) {
            tableData.push([
                data[i].member_username,
                data[i].money,
                data[i].x,
                formatDate(data[i].date_time) + ' ' + formatTime(data[i].date_time),
                data[i].name
            ])
        }

    } else if (resPromotionHistory.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resPromotionHistory.description,
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
        })
    }
    initDataTables(tableData, 'logs', column);
}