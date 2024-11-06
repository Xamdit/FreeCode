require('dotenv').config()
const mysql = require('./config/mysql');
const app = require('./config/express')();
const { autoTurnover } = require('./app/controllers/turnover.controller');
const { autoTokenUfa } = require('./app/controllers/backend.controller');
const port = process.env.PORT || 11010;
mysql.db(async function(db) {
    if (db) {
        app.listen(port);
        module.exports = app;
        console.log('server-bakcend running at port ' + port);
        // await autoTurnover();
        setInterval(async() => {
            await autoTokenUfa();
        }, 300000);
        setInterval(async() => {
            await autoTurnover();
        }, 600000);
    } else {
        logError.historyLogError(JSON.stringify(db));
        console.log('server-bakcend is error ');
    }
});