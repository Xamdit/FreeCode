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