const db = require("../config/db");

//Get All Students List
const getStudents = async (req, res) => {
  try {
    const data = await db.query(`SELECT * FROM students`);
    if (!data) {
      return res.status(404).send({
        success: false,
        message: "No record found for Get All Students List",
      });
    }
    res.status(200).send({
      success: true,
      message: "All students records",
      totalStudents: data[0].length,
      data: data[0],
    });
  } catch (error) {
    console.log(error);
    res.status(500).send({
      success: false,
      message: "Error in Get All Students List API",
      error,
    });
  }
};

//GET STUDENT BY ID
const getStudentById = async (req, res) => {
  try {
    const studentId = req.params.id;
    if (!studentId) {
      return res.status(404).send({
        success: false,
        message: "INVALID or PROVIDE STUDENT ID",
      });
    }
    // const data = await db.query(`SELECT * FROM students WHERE id=` + studentId);
    const data = await db.query(`SELECT * FROM students WHERE id=?`, [
      studentId,
    ]); //no sql injection this way
    if (!data) {
      return res.status(404).send({
        success: false,
        message: "No record found for Get All Students List",
      });
    }
    res.status(200).send({
      success: true,
      message: "All students records",
      totalStudents: data[0].length,
      studentDetails: data[0],
    });
  } catch (error) {
    console.log(error);
    res.status(500).send({
      success: false,
      message: "Error in GET STUDENT BY ID",
      error,
    });
  }
};

module.exports = { getStudents, getStudentById };
