const fs = require('fs');
const moment = require('moment');

exports.historyLogError = (param) => {
    let path = require('path').resolve(__dirname, '../logs/err')
    const text_date = new Date();
    fs.appendFile(path + `/log-${moment.utc().format('DD-MM-YYYY')}.log`, `${text_date} : ${param}` + '\n', (err) => {
        if (err) {
            fs.promises.mkdir(path, { recursive: true }).then(
                () => fs.promises.appendFile(path + `/log-${moment.utc().format('DD-MM-YYYY')}.log`, text_date + ' ' + ':' + ' ' + param + '\n', (err) => {
                    if (err) {
                        throw err;
                    }
                    console.log('insert history log error !');
                })
            );
        }
    });
}