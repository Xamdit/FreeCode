<?php print_r($user) ?>
<link rel="stylesheet" href="/assets/css/superwheeladmin.css"> <!-- superWheel -->
<!-- สุ่มวงล้อ -->
        <!--###################################### สุ่มวงล้อ ######################################-->

        <div class="x-modal modal" id="wheelspin" tabindex="-1" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered -modal-size " role="document" style="padding-top: 60px;background-image: 0 !important;background: 0 !important;">
                <div class="modal-content -modal-content" style="border: 2px solid #fdd741;">
                    <img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
                    <button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
                        <h3 class="m-auto  d-inline-block" style="color:#fff">
                            วงล้อเสี่ยงโชค
                            <hr class="x-hr-border-glow">
                        </h3>
                    </div>
                    <div class="modal-body" style="top: 5px;">
                        <div class="wheel-horizontal superWheel _0" style="font-size: 16px; width: 300px; height: 300px;margin-top: 0px;">
                        </div>
                        <p id="btn_wheelspin"></p>
                        <br>
                        <table class="table text-white">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center" style="color:#e1bd4f;">จำนวนเครดิต</th>
                                    <th scope="col" class="text-center" style="color:#e1bd4f;">วันที่ทำรายการ</th>
                                </tr>
                            </thead>
                            <tbody id="transaction_wheel">
                            </tbody>

                        </table>
                    </div>
                    <img src="" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
                </div>
            </div>
        </div>
        <!--###################################### สุ่มวงล้อ ######################################-->

        <!-- สุ่มวงล้อ -->
        
        
        <?php if ($user) {  ?>
        <script>
            function setDataTransactionWheel() {
                $.ajax({
                    url: 'apwheel/table/<?= $user ?>',
                    method: 'get',
                    success: function(data) {
                        let result = data.data;
                        let htm = '';
                        for (let i = 0; i < result.length; i++) {
                            htm += '<tr>';
                            htm += '<td scope="row" class="text-center" style="color:#fff;">' + result[i].credit + ' เครดิต</td>';
                            htm += '<td scope="row" class="text-center" style="color:#fff;">' + result[i].create_date + '</td>';
                            htm += '</tr>';
                        }
                        document.getElementById('transaction_wheel').innerHTML = htm;
                        if ($('.modal.show').length < 1) {
                            showWheelModal();
                        }
                    }
                })
            }

            function getDataSpinCan() {
                $.ajax({
                    url: 'apwheel/getrole/<?= $user ?>',
                    method: 'get',
                    success: function(data) {
                        if (data.status) {
                            document.getElementById('btn_wheelspin').innerHTML = '<button type="button" class="btn btn-primary btn-lg btn-block wheel-horizontal-spin-button" style="background: linear-gradient(180deg, rgb(60, 56, 32), rgb(133, 118, 0));color: #fff;border: 1 px solid #f1c40f;">สุ่มวงล้อ</button>';
                        } else {
                            document.getElementById('btn_wheelspin').innerHTML = '<button type="button" class="btn btn-primary btn-lg btn-block" style="background: linear-gradient(180deg, rgb(60, 56, 32), rgb(133, 118, 0));color: #fff;border: 1 px solid #f1c40f;" disabled>วันนี้สุ่มไปแล้ว รอพรุ่งนี้นะคะ</button>';
                        }
                    }
                })
            }

            function showWheelModal() {
                $('#wheelspin').modal({
                    show: true
                });
            }

            $('#wheelspin_pc').click(() => {
                <?php if ($setting_w['status'] == 1) { ?>
                    setWheel();
                    getDataSpinCan();
                    setDataTransactionWheel();
                <?php  } else { ?>
                    Swal.fire(
                        'แจ้งเตือน !',
                        'วงล้อยังไม่เปิดใช้บริการ',
                        'warning'
                    )
                <?php  } ?>
            })
            $('#wheelspinufa').click(() => {
                <?php if ($setting_w['status'] == 1) { ?>
                    setWheel();
                    getDataSpinCan();
                    setDataTransactionWheel();
                <?php  } else { ?>
                    Swal.fire(
                        'แจ้งเตือน !',
                        'วงล้อยังไม่เปิดใช้บริการ',
                        'warning'
                    )
                <?php  } ?>
            })
            $('#wheelspinufa_1').click(() => {
                <?php if ($setting_w['status'] == 1) { ?>
                    setWheel();
                    getDataSpinCan();
                    setDataTransactionWheel();
                <?php  } else { ?>
                    Swal.fire(
                        'แจ้งเตือน !',
                        'วงล้อยังไม่เปิดใช้บริการ',
                        'warning'
                    )
                <?php  } ?>
            })

            $('#wheelspinufa_2').click(() => {
                <?php if ($setting_w['status'] == 1) { ?>
                    setWheel();
                    getDataSpinCan();
                    setDataTransactionWheel();
                <?php  } else { ?>
                    Swal.fire(
                        'แจ้งเตือน !',
                        'วงล้อยังไม่เปิดใช้บริการ',
                        'warning'
                    )
                <?php  } ?>
            })

            $('#wheelspinufa_mobile').click(() => {
                <?php if ($setting_w['status'] == 1) { ?>
                    setWheel();
                    getDataSpinCan();
                    setDataTransactionWheel();
                <?php  } else { ?>
                    Swal.fire(
                        'แจ้งเตือน !',
                        'วงล้อยังไม่เปิดใช้บริการ',
                        'warning'
                    )
                <?php  } ?>

            })

            var tick = new Audio('assets/sound/tick.mp3');
            $(document).on('click', '.wheel-horizontal-spin-button', function(e) {
                if (true) {
                    $.ajax({
                        url: 'apwheel/getrd/<?= $user ?>',
                        method: 'get',
                        success: async function(data) {
                            await $('.wheel-horizontal').superWheel('start', 'value', data.data.num);
                            $(this).prop('disabled', true);

                        }
                    })
                } else {
                    Swal.fire(
                        'แจ้งเตือน !',
                        'คุณยังไม่ได้ Login!',
                        'warning'
                    )
                }
            });

            function setWheel() {
                let result = [];
                <?php
                $i = 0;
                foreach ($setting_w_type as $v) {  ?>
                    result[<?php echo $i; ?>] = {};
                    result[<?php echo $i; ?>] = {
                        des: '<?php echo $v['description'] ?>',
                        color: '<?php echo $v['color'] ?>',
                        credit: '<?php echo $v['value'] ?>',
                        value: <?php echo $i++; ?>
                    };
                <?php  } ?>



                let slices = [];
                for (let i = 0; i < result.length; i++) {
                    slices[i] = {};
                    slices[i].background = result[i].color;
                    slices[i].text = result[i].credit != 0 ? result[i].credit + ' เครดิต' : 'ไม่ได้เครดิต';
                    slices[i].des = result[i].des;
                    slices[i].value = result[i].value;
                    slices[i].credit = result[i].credit;
                }

                $('.wheel-horizontal').superWheel({
                    slices: slices,
                    text: {
                        color: '<?= $setting_w['text_color'] ?>',
                        offset: 8,
                        size: <?= $setting_w['text_size'] ?>,
                        letterSpacing: 0,
                        orientation: '<?= $setting_w['text_type'] ?>',
                    },
                    line: {
                        width: 6,
                        color: "<?= $setting_w['line_color'] ?>"
                    },
                    outer: {
                        width: 12,
                        color: "<?= $setting_w['outer_color'] ?>"

                    },
                    inner: {
                        width: 2,
                        color: "<?= $setting_w['inner_color'] ?>",
                    },
                    marker: {
                        background: "#00BCD4"
                    },
                    center: {
                        width: 30,
                        background: '<?= $setting_w['center_color'] ?>',
                        rotate: true,
                        class: "",
                        image: {
                            url: "<?= $setting_w['center_img'] ?>",
                            width: 45
                        }
                    },
                    selector: "value"
                });

                $('.wheel-horizontal').superWheel('onStart', function(results) {
                    $('.wheel-horizontal-spin-button').text('Spinning...');
                });

                $('.wheel-horizontal').superWheel('onStep', function(results) {
                    if (typeof tick.currentTime !== 'undefined')
                        tick.currentTime = 0;
                    tick.play();
                });


                $('.wheel-horizontal').superWheel('onComplete', function(results) {
                    let result = '';
                    let title = '';
                    let icon = '';
                    if (results.credit != 0) {
                        result = results.des;
                        title = 'ยินดีด้วย!';
                        icon = 'success';
                    } else {
                        result = results.des;
                        title = 'เสียใจด้วย!';
                        icon = 'error';
                    }
                    Swal.fire({
                        type: '',
                        icon: icon,
                        title: title,
                        html: result
                    }).then((result) => {
                        if (result) {
                            document.getElementById('btn_wheelspin').innerHTML = '<button type="button" class="btn btn-primary btn-lg btn-block" disabled>วันนี้สุ่มไปแล้ว รอพรุ่งนี้นะคะ</button>';
                            setDataTransactionWheel();
                            $.ajax({
                                url: 'apiufa/Balance',
                                method: 'get',
                                success: function(data) {
                                    var rr = JSON.parse(data);
                                    $('.ufabet-credit').html(rr.balance)
                                }
                            })
                        }
                    });
                    $('.wheel-horizontal-spin-button:disabled').prop('disabled', false).text('Spin');
                });
            }
        </script>
    <?php } ?>
    <script>
    $('#wheelspinufa_2').click(() => {
                <?php if ($setting_w['status'] == 1) { ?>
                    setWheel();
                    getDataSpinCan();
                    setDataTransactionWheel();
                <?php  } else { ?>
                    Swal.fire(
                        'แจ้งเตือน !',
                        'วงล้อยังไม่เปิดใช้บริการ',
                        'warning'
                    )
                <?php  } ?>
            })
            
            $('#wheelspin_pc').click(() => {
                <?php if ($setting_w['status'] == 1) { ?>
                    setWheel();
                    getDataSpinCan();
                    setDataTransactionWheel();
                <?php  } else { ?>
                    Swal.fire(
                        'แจ้งเตือน !',
                        'วงล้อยังไม่เปิดใช้บริการ',
                        'warning'
                    )
                <?php  } ?>
            })
            
            </script>