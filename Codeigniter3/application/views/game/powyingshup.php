<style>
            .containers {
                display: flex;
            }

            .containers .section {
                width: 350px;
                margin: 20px 41px;
            }

            .section .info {
                color: #000;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 50px;
            }

            .info span,
            .info h3 {
                font-size: 25px;
                font-weight: bold;
                margin: 0px 10px;
                color: white;
            }

            .show {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .show i {
                font-size: 100px;
                color: #fdd741;
            }

            .shows i {
                font-size: 25px;
                color: #fdd741;
            }

            .selection {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100px;
            }

            .selection button {
                margin: 0 20px;
                padding: 25px;
                border-radius: 50%;
                border: none;
                outline: none;
                cursor: pointer;
                background: rgb(15 11 6);
                font-size: 33px;
                color: #fdd741;
            }
        </style>

<div class="x-modal modal" id="powyingshup" tabindex="-1" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered -modal-size " role="document" style="padding-top: 60px;background-image: 0 !important;background: 0 !important;">
                <div class="modal-content -modal-content" style="border: 2px solid #fdd741;">
                    <img src="" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
                    <button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
                        <h3 class="m-auto  d-inline-block" style="color:#fff">
                            เป่ายิ้งฉุบ
                            <hr class="x-hr-border-glow">
                        </h3>
                    </div>
                    <div class="modal-body" style="top: 5px;padding:0px;overflow: auto;">
                        <div class="text-center">
                            <span style="color:orange;font-size:1.5rem;">เล่นได้อีก : </span><span style="color:green;font-size:1.5rem;" id="play_pow">Waiting...</span>
                        </div>
                        <div class="containers">
                            <!--   The first section     -->
                            <div class="section">
                                <div class="info">
                                    <h3>You</h3>
                                </div>
                                <div class="show" style="padding: 25px;border-radius: 50%;border: none;outline: none;background: rgb(15 11 6);font-size: 33px;color: orange;">
                                    <i class="fas fa-hand-rock"></i>
                                </div>
                            </div>
                            <!--   The second section     -->
                            <div class="section">
                                <div class="info">
                                    <h3>Computer</h3>
                                </div>
                                <div class="show computer" style="padding: 25px;border-radius: 50%;border: none;outline: none;background: rgb(15 11 6);font-size: 33px;color: orange;">
                                    <i class="fas fa-hand-scissors"></i>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h2 class="text-center" style="color: rgb(233, 33, 19);" id="">เลือกเพื่อเล่น !</h2>
                        <br>
                        <!-- This selection div contains the buttons   -->
                        <div class="selection text-center">
                            <button class="fas fa-hand-rock" id="rock"></button>
                            <button class="fas fa-hand-paper" id="paper"></button>
                            <button class="fas fa-hand-scissors" id="scissors"></button>
                        </div>
                        <br>
                        <table class="table text-white">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center" style="color:white;">จำนวนเครดิต</th>
                                    <th scope="col" class="text-center" style="color:white;">ผลการออก</th>
                                    <th scope="col" class="text-center" style="color:white;">วันที่ทำรายการ</th>
                                </tr>
                            </thead>
                            <tbody id="transaction_powyingshup">
                            </tbody>

                        </table>
                    </div>
                    <img src="" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
                </div>
            </div>
        </div>
        
        <script>
    function setData_powyingshup() {
            <?php if ($setting_pow[0]['status'] == 1) {   ?>
                setDataTransactionPowyingshup();
                $.ajax({
                    url: 'appowyingshup/getrole/<?= $user ?>',
                    method: 'get',
                    success: function(data) {
                        document.getElementById('play_pow').innerHTML = data.data[0].powyingshup + ' ครั้ง';
                    }
                })
                showPowyingshupModal();
            <?php } else { ?>
                Swal.fire(
                    'แจ้งเตือน !',
                    'ระบบปิดปรับปรุงชั่วคราว',
                    'error'
                )
            <?php } ?>
        }
        // Setting the scores and selecting our HTML elements.
        const buttons = document.querySelectorAll('.selection button');
        const showIcon = document.querySelector('.show i');
        const computerShowIcon = document.querySelector('.computer i');
        // The randomClass array below this contains the rock,paper, and scissor Icon from font-awesome.
        const randomClasses = ["fas fa-hand-rock", "fas fa-hand-paper", "fas fa-hand-scissors"];
        const text = document.getElementById('demo');
        const text2 = document.getElementById('demo2');

        // Game Functionality: Setting forEach function for the buttons.
        const game = () => {
            buttons.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    // Random rock paper scissor for the computer and the player
                    document.getElementById('rock').disabled = true;
                    document.getElementById('paper').disabled = true;
                    document.getElementById('scissors').disabled = true;
                    $.ajax({
                        url: 'appowyingshup/checkrole/<?= $user ?>',
                        method: 'get',
                        success: function(data) {
                            if (data.status) {

                                let clickedBtn = e.target.className;
                                showIcon.className = clickedBtn;
                                let randomNum = Math.floor(Math.random() * randomClasses.length);
                                computerShowIcon.className = randomClasses[randomNum];
                                // Game Score.
                                // If it's a Tie .
                                if (showIcon.className === computerShowIcon.className) {
                                    alert_pow('คุณเสมอ ไม่ได้รับเครดิต', 'warning', 0);
                                } else if (showIcon.className === randomClasses[0] && computerShowIcon.className === randomClasses[2]) {
                                    alert_pow('คุณชนะ ได้รับ ' + data.credit + ' บาท', 'success', 2);
                                } else if (showIcon.className === randomClasses[0] && computerShowIcon.className === randomClasses[1]) {
                                    alert_pow('คุณแพ้ ไม่ได้รับเครดิต', 'error', 1);
                                } else if (showIcon.className === randomClasses[1] && computerShowIcon.className === randomClasses[2]) {
                                    alert_pow('คุณแพ้ ไม่ได้รับเครดิต', 'error', 1);
                                } else if (showIcon.className === randomClasses[1] && computerShowIcon.className === randomClasses[0]) {
                                    alert_pow('คุณชนะ ได้รับ ' + data.credit + ' บาท', 'success', 2);
                                } else if (showIcon.className === randomClasses[2] && computerShowIcon.className === randomClasses[0]) {
                                    alert_pow('คุณแพ้ ไม่ได้รับเครดิต', 'error', 1);
                                } else if (showIcon.className === randomClasses[2] && computerShowIcon.className === randomClasses[1]) {
                                    alert_pow('คุณชนะ ได้รับ ' + data.credit + ' บาท', 'success', 2);
                                }
                            } else {
                                Swal.fire(
                                    'แจ้งเตือน !',
                                    'ไม่สามารถเล่นได้ จำนวนครั้งในการเล่นหมดแล้ว',
                                    'error'
                                )
                                document.getElementById('rock').disabled = false;
                                document.getElementById('paper').disabled = false;
                                document.getElementById('scissors').disabled = false;
                            }
                        }
                    })
                });
            });
        }
        // Calling the function.
        game();
        // This function contains all the game logic.

        function alert_pow(msg, icon, type) {
            setTimeout(function() {
                Swal.fire(
                    'แจ้งเตือน !',
                    msg,
                    icon
                )
            }, 500)
            $.ajax({
                url: 'appowyingshup/updateresult',
                method: 'post',
                data: {
                    username: '<?= $user ?>',
                    type: type
                },
                success: function(data) {
                    setData_powyingshup();
                    $.ajax({
                        url: 'apiufa/Balance',
                        method: 'get',
                        success: function(data) {
                            setDataTransactionPowyingshup();
                            var rr = JSON.parse(data);
                            $('.ufabet-credit').html(rr.balance)
                        }
                    })
                    document.getElementById('rock').disabled = false;
                    document.getElementById('paper').disabled = false;
                    document.getElementById('scissors').disabled = false;
                }
            })
        }

        function setDataTransactionPowyingshup() {
            $.ajax({
                url: 'appowyingshup/table/<?= $user ?>',
                method: 'get',
                success: function(data) {
                    let result = data.data;
                    let htm = '';
                    for (let i = 0; i < result.length; i++) {
                        htm += '<tr>';
                        if (result[i].result == 2) {
                            htm += '<td scope="row" class="text-center" style="color:#fff;">' + result[i].credit + ' เครดิต</td>';
                            htm += '<td scope="row" class="text-center" style="color:green;"> ชนะ </td>';
                        } else {
                            htm += '<td scope="row" class="text-center" style="color:#fff;">0 เครดิต</td>';
                            if (result[i].result == 1) {
                                htm += '<td scope="row" class="text-center" style="color:yellow;"> เสมอ </td>';
                            } else {
                                htm += '<td scope="row" class="text-center" style="color:red;"> แพ้ </td>';
                            }

                        }
                        htm += '<td scope="row" class="text-center" style="color:#fff;">' + result[i].date + '</td>';
                        htm += '</tr>';
                    }
                    document.getElementById('transaction_powyingshup').innerHTML = htm;
                }
            })
        }

        function showPowyingshupModal() {
            $('#powyingshup').modal({
                show: true
            });
        }
</script>
        