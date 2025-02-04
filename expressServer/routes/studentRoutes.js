const express = require("express");
const { getStudents } = require("../contollers/studentController");

//router objects
const router = express.Router();

//Routes
//Get All Students list || GET
router.get("/getall", getStudents);
module.exports = router;
