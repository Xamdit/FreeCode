showAlert()
function showAlert() {
    Swal.fire({
        // Maintenance
        imageUrl: '/img/ufabet-maintenance.jpg',
        html : '<div>ระบบ: แจ้งปิดปรับปรุงระบบ เพื่อเพิ่มประสิทธิภาพในการทำงาน ในวันที่ [ 06/05/2020 วันพุธ] เวลา 11:00น คาดว่าจะแล้วเสร็จในเวลาประมาณ 17.30น. ทางบริษัทต้องขออภัยในความไม่สะดวก</div><br>' + 
        '<div class="form-check">' +
          '<input class="form-check-input js-msg-alert" type="checkbox" value="" id="msg-deposit">' + 
          '<label class="form-check-label" for="msg-deposit">' +
            'ไม่ต้องแสดงข้อความนี้อีก' +
          '</label>' +
        '</div>',
        confirmButtonText: 'ปิด'
    }).then((result) => {
        if (result.value && $('.js-msg-alert').is(':checked')) {
            $.get('/hide-alert')
        }
    })
}
