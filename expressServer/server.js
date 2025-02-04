const colors = require("colors");
const express = require("express");
const morgan = require("morgan");
const dotenv = require("dotenv");
const mySqlPool = require("./config/db");

//configured dotenv
dotenv.config();

//rest object
const app = express();

//middlewares
app.use(morgan("dev"));
app.use(express.json());

//routes
app.use("/api/v1/student", require("./routes/studentRoutes"));

app.get("/test", (req, res) => {
  res.status(200).send(`<h1>Backend MySQL App</h1>`);
});

//port
const PORT = process.env.PORT || 8080;

//conditionally listen
mySqlPool
  .query("SELECT 1")
  .then(() => {
    //MY SQL
    console.log("Mysql DB connected".bgCyan.white);

    //listen
    app.listen(PORT, () => {
      console.log(`Server running on port ${PORT}`.bgMagenta.white);
    });
  })
  .catch((error) => {
    console.log(error);
  });
