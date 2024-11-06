$(document).ready(async function() {
    let date = new Date();
    el('month').value = date.getMonth() + 1;
    el('year').value = date.getFullYear();
    setData();
    hideLoader();

});

function initDataTables(tableData, id, column) {

    $('#' + id).DataTable({
        "order": [
            [5, "desc"]
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

async function setData() {
    let month = el('month').value;
    let year = el('year').value;
    let data = {
        month: month,
        year: year
    };

    let resFinance = await callXMLHttpRequest(`${apiPort.apiQueryFinanceReport}`, data);
    if (resFinance.statusCodeText == textRespone.ok.CodeText) {
        // 
        // for (let i = 0; i < data.length; i++) {
        //     tableData.push([
        //         data[i].member_username,
        //         data[i].name,
        //         data[i].accnum,
        //         data[i].bank_name,
        //         formatMoneyNotDecimal(data[i].amount),
        //         formatDate(data[i].date) + ' ' + formatTime(data[i].date)

        //     ])
        // }
        let htm = '';
        data = resFinance.finance;
        let deposit = 0;
        let withdraw = 0;
        for (let i = 0; i < data.length; i++) {
            deposit += data[i].deposit;
            withdraw += data[i].withdraw;
            let total = data[i].deposit - data[i].withdraw;
            let result = '';
            if (total >= 0) {
                result = '<span style="color:green">' + formatMoney(total) + '</span>';
            } else {
                result = '<span style="color:red">' + formatMoney(total) + '</span>';
            }

            htm += '<tr>';
            htm += '<td class="text-center">' + (i + 1) + '</td>';
            htm += '<td class="text-center">' + formatMoney(data[i].deposit) + '</td>';
            htm += '<td class="text-center">' + formatMoney(data[i].withdraw) + '</td>';
            htm += '<td class="text-center">' + result + '</td>';
            htm += '</tr>';
        }
        let total = deposit - withdraw;
        let resulttotaal = '';
        if (total >= 0) {
            resulttotaal = '<span style="color:green">' + formatMoney(total) + '</span>';
        } else {
            resulttotaal = '<span style="color:red">' + formatMoney(total) + '</span>';
        }
        htm += '<tr>';
        htm += '<td class="text-center"><strong>รวมสุทธิ</strong></td>';
        htm += '<td class="text-center">' + formatMoney(deposit) + '</td>';
        htm += '<td class="text-center">' + formatMoney(withdraw) + '</td>';
        htm += '<td class="text-center">' + resulttotaal + '</td>';
        htm += '</tr>';
        el('tb_deposit').innerHTML = htm;

    } else if (resFinance.statusCodeText == "401") {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: resFinance.description,
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