const express = require("express");
const {
  getStudents,
  getStudentById,
} = require("../contollers/studentController");

//router objects
const router = express.Router();

//Routes
//Get All Students list || GET
router.get("/getall", getStudents);

//Get Students by Id
router.get("/get/:id", getStudentById); //using params

module.exports = router;
