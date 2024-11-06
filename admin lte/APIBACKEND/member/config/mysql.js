var mysql = require('mysql');
const dbConfig = require('../constants/dbCon');
const logError = require('../../unityFunction/functionLogError');
module.exports.db = (callback) => {
	con = mysql.createConnection({
		host: dbConfig.host,
		user: dbConfig.user,
		password: dbConfig.password,
		database: dbConfig.database
	});
	con.connect(function (err) {
		if (err) {
			console.log(err);
			console.log("Database Fail Connected!");
			callback({
				status: false,
			});
		} else {
			console.log("Database Connected!");
			callback({ status: true });
		}
	});
}



