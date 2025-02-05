const express = require("express");
const {
  getStudents,
  getStudentById,
  createStudent,
  updateStudent,
  deleteStudent,
} = require("../contollers/studentController");

//router objects
const router = express.Router();

//Routes
//Get All Students list || GET
router.get("/getall", getStudents);

//Get Students by Id
router.get("/get/:id", getStudentById); //using params

//Create student record || POST
router.post("/create", createStudent); //using params

//update student record || PUT
router.put("/update/:id", updateStudent); //using params

//delete student record || DELETE
router.delete("/delete/:id", deleteStudent); //using params

module.exports = router;
