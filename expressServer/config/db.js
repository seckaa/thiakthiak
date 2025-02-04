const mysql = require("mysql2/promise");

const mySqlPool = mysql.createPool({
  host: "localhost",
  user: "root",
  database: "students_db",
  port: 3306,
  password: "P@ssword1234",
  //   waitForConnections: true,
  //   connectionLimit: 10,
  //   idleTimeout: 60000,
  //   queueLimit: 0,
  //   enableKeepAlive: true,
  //   keepAliveInitialDelay: 0,
});

module.exports = mySqlPool;
