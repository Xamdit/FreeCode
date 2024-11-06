const queryMember = require('../functions/qdmbackend');
const stt = require('../../constants/statusText');
const http = require('../../constants/httpStatusCodes');
let crypto = require('crypto');
let request = require('request');
let querystring = require('querystring');
const jwt = require('jsonwebtoken');
const httpStatusCodes = require('../../constants/httpStatusCodes');
var CronJob = require('cron').CronJob;
const site = require('../../constants/urlsite');


const regex = /([^,]+),([^,]+)/;
let m;
var e2Module;
var e2RsaExponent;
 
// ###########################  Unity Function #########################################
function aes256(password) {
    return new Promise((resolve, reject) => {
        let genpw = password;
        let fp1 = genpw;
        let key = 'aPjr2QDDfjmb72Vs';
        let cipher = crypto.createCipher('aes256', key);
        let fp2 = cipher.update(fp1, 'base64', 'base64') + cipher.final('base64');
        resolve({ genpw: genpw, fp2: fp2 });
    });
}

function formatMoneyNotDecimal(n, c, d, t) {
    var c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t);
}

function formatTime(d) {
    let date = new Date(d);
    let hh = date.getHours();
    let mm = date.getMinutes();
    let ss = date.getSeconds();
    if (hh < 10) {
        hh = '0' + hh;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }
    if (ss < 10) {
        ss = '0' + ss;
    }
    let result = hh + ":" + mm + ":" + ss;
    return result;
}

function formatDate(d) {
    let date = new Date(d);
    let dd = date.getDate();
    let mmm = date.getMonth() + 1;
    let yy = date.getFullYear();
    if (mmm < 10) {
        mmm = '0' + mmm;
    }
    let result = dd + "/" + mmm + "/" + yy;
    return result;
}

function formatDate1(d) {
    let date = new Date(d);
    let dd = date.getDate();
    let mmm = date.getMonth() + 1;
    let yy = date.getFullYear();
    if (mmm < 10) {
        mmm = '0' + mmm;
    }
    if (dd < 10) {
        dd = '0' + dd;
    }
    let result = yy + "-" + mmm + "-" + dd;
    return result;
}

function sendMessageLineNotify(req, messageBody) {
    request({
        method: 'POST',
        uri: 'https://notify-api.line.me/api/notify',
        headers: {
            'Content-Type': 'application/json'
        },
        auth: {
            'bearer': req.token
        },
        form: {
            message: messageBody
        }
    });
}

async function authenParse(token) {
    try {
        let split = token;
        let parseToken = split.split('Bearer ');
        let result = await parseJwt(parseToken[1]);
        console.log(parseToken[0]);
        console.log(parseToken[1]);
        return result;
    } catch (e) {
        return false;
    }

}

function jwtData(params) {
    return new Promise((resolve, reject) => {
        let payload = params;
        let secret = 'eyJhbGciOiJIUzI1N';
        var token = jwt.sign(payload, secret, {
            expiresIn: '16h'
        });
        resolve(token);
    });
}

function parseJwt(token) {
    var base64Payload = token.split('.')[1];
    var payload = Buffer.from(base64Payload, 'base64');
    return JSON.parse(payload.toString());
}


// ###########################  Unity Function #########################################
// res.setHeader('Content-Type', 'application/json');
// let token = await authenParse(req.headers.authorization);
// res.send({ msg: token });
module.exports.auto_deposit = async(req, res) => {
    var job = new CronJob('0-59/30 * * * * *', async function() {
        let settings = await queryMember.querySetting();
        let data_req = {};
        if (settings.result[0].status == 1) {
            let min = settings.result[0].credit_min;
            let max = settings.result[0].credit_max;
            let limit = settings.result[0].credit_limit;
            data_req.min = min;
            data_req.max = max;
            data_req.date = formatDate1(new Date());
            let data = await queryMember.queryMemberWithdraw(data_req);
            let data_check = await queryMember.queryAmountToday(data_req);
            let amount_now = data_check.result[0].amount ? data_check.result[0].amount : 0;
            console.log('=============================================================');
            console.log('เครดิตถอนที่่ถอนได้ ' + amount_now + '/' + limit + ' บาท');
            console.log('=============================================================');
            console.log('มี ' + data.result.length + ' ยูสเซอร์ กำลังรอถอน || ' + formatDate(new Date()) + ' ' + formatTime(new Date()));
            if (data.status && data.result.length > 0) {
                let username = data.result[0].member_username;
                let amount = data.result[0].amount;
                let name = data.result[0].name;
                let bank = data.result[0].bank_name;
                let bankcode = data.result[0].code;
                let bankacc = data.result[0].accnum;
                let id = data.result[0].tid;
                let date = formatDate1(new Date()) + ' ' + formatTime(new Date());
                let date_new = formatDate1(new Date());
                let total = data_check.result[0].amount + amount;
                console.log('=============================================================');
                console.log('กำลังถอนให้ ' + username + ' จำนวน : ' + amount + ' บาท || ' + formatDate(new Date()) + ' ' + formatTime(new Date()));
                if (total <= limit) {
                    data_req.username = username;
                    data_req.name = name;
                    data_req.bank = bank;
                    data_req.amount = amount;
                    data_req.bankacc = bankacc;
                    data_req.date = date;
                    data_req.date_new = date_new;
                    var options = {
                        'method': 'GET',
                        'url': site.url + '/sys/scbapi/' + bankcode + '/' + bankacc + '/' + amount + '/CUfL4levur',
                        'headers': {}
                    };
                    request(options, async function(error, result) {
                        if (error) throw new Error(error);
                        let htm = JSON.parse(result.body)
                        if (htm.status.description == "สำเร็จ") {
                            console.log('=============================================================');
                            console.log('โอนเงินให้ ' + username + ' จำนวน ' + amount + ' บาท สำเร็จ || ' + formatDate(new Date()) + ' ' + formatTime(new Date()));
                            await queryMember.insertLogAutoWithdraw(data_req);
                            await queryMember.updateTransaction(id);
                            let lineNotify = {};
                            let data_setting = await queryMember.querySettingLine();
                            lineNotify.token = data_setting.result[0].token_line_with;
                            let messageBody = '\n✅อนุมัติการถอนเงินให้(ออโต้)✅️️' +
                                '\nสมาชิก => ' + username +
                                '\nธนาคารลูกค้า => ' + bank +
                                '\nเลขบัญชี => ' + bankacc +
                                '\nจำนวนเงินที่ถอน => ' + amount + ' บาท' +
                                '\nสถานะ => โอนเงินผ่านระบบออโต้แล้ว'
                            sendMessageLineNotify(lineNotify, messageBody)
                        }
                    });
                } else {
                    console.log('=============================================================');
                    console.log('จำนวนเครดิตต่อวันเกินแล้ว ไม่สามารถถอนออโต้ได้');
                }
            }
        } else {
            console.log('=============================================================');
            console.log('ระบบออโต้ปิดทำงาน');
            console.log('=============================================================');
        }
    }, null, true, 'America/Los_Angeles');
}