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
const { DATETIME } = require('mysql/lib/protocol/constants/types');


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

function formatDateCheck(d) {
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
    let result = mmm + "/" + dd + "/" + yy;
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
module.exports.autoTurnover = async(req, res) => {
    try {
        var options = {
            'method': 'POST',
            'url': site.url + '/apitopup/check_turnover_user1',
            'headers': {

            },
            formData: {
                'date': formatDateCheck(new Date())

            }
        };
        request(options, async function(error, response) {
            if (error) throw new Error(error);
            let htm = JSON.parse(response.body)
            var res = [];
            let obj = htm.msg;
            for (var i in obj)
                res.push(obj[i]);
            htm.msg = res;
            let data_str = htm.date;
            let data_split = data_str.split('/');
            let date = data_split[1] + '-' + data_split[0] + '-' + data_split[2];
            let data = [];
            for (let i = 0; i < htm.msg.length; i++) {
                // let data = {
                //     keybydaya: date + htm.msg[i].username,
                //     username: htm.msg[i].username,
                //     turnover: htm.msg[i].turnover,
                //     winloss: htm.msg[i]['w/l'],
                //     date: date
                // }
                data.push([date + htm.msg[i].username, htm.msg[i].username, htm.msg[i].turnover, htm.msg[i]['w/l'], date])
            }
            if (data.length > 0) {
                const resUpdate = await queryMember.insertLogTurnover(data);
                if (resUpdate.status) {
                    console.log(`Update TurnOver Success`);
                }
            } else {
                console.log(`Emptry Update TurnOver`);
            }

        });
    } catch (error) {
        console.log(error)
    }
    // var job = new CronJob('0-59/1 * * * * *', async function() {
    //     if (formatTime(new Date()) == '23:55:00') {
    //         var options = {
    //             'method': 'POST',
    //             'url': site.url + 'apitopup/check_turnover_user1',
    //             'headers': {

    //             },
    //             formData: {
    //                 'date': formatDateCheck(new Date())

    //             }
    //         };
    //         request(options, async function(error, response) {
    //             if (error) throw new Error(error);
    //             let htm = JSON.parse(response.body)
    //             var res = [];
    //             let obj = htm.msg;
    //             for (var i in obj)
    //                 res.push(obj[i]);
    //             htm.msg = res;
    //             let data_str = htm.date;
    //             let data_split = data_str.split('/');
    //             let date = data_split[1] + '-' + data_split[0] + '-' + data_split[2];
    //             let data = [];
    //             for (let i = 0; i < htm.msg.length; i++) {
    //                 // let data = {
    //                 //     keybydaya: date + htm.msg[i].username,
    //                 //     username: htm.msg[i].username,
    //                 //     turnover: htm.msg[i].turnover,
    //                 //     winloss: htm.msg[i]['w/l'],
    //                 //     date: date
    //                 // }
    //                 data.push([date + htm.msg[i].username, htm.msg[i].username], htm.msg[i].turnover, htm.msg[i]['w/l'], date)
    //             }
    //             await queryMember.insertLogTurnover(data);
    //         });


    //     }
    // }, null, true, 'America/Los_Angeles');

}