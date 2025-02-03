const colors = require("colors");
const express = require("express");
const morgan = require("morgan");
const dotenv = require("dotenv");

//configured dotenv
dotenv.config();

//rest objet
const app = express();

//middlewares
app.use(morgan("dev"));

//routes
app.get("/test", (req, res) => {
  res.status(200).send(`<h1>Backend MySQL App</h1>`);
});

//port
const PORT = process.env.PORT || 8080;

//listen
app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`.bgMagenta.white);
});
