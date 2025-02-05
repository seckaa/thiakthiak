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

//CREATE STUDENT
const createStudent = async (req, res) => {
  try {
    const { name, roll_no, class_, medium, fees } = req.body;
    if (!name || !roll_no || !class_ || !medium || !fees) {
      return res.status(500).send({
        success: false,
        message: "Please fill in all required fields",
      });
    }

    const data = await db.query(
      `INSERT INTO students (name, roll_no, class_, medium, fees) VALUES (?,?,?,?,?)`,
      [name, roll_no, class_, medium, fees]
    );
    if (!data) {
      return res.status(404).send({
        success: false,
        message: "Error in INSERT QUERY",
      });
    }
    res.status(201).send({
      success: true,
      message: "new student added to record",
      totalStudents: data[0].length,
      data: data[0],
    });
  } catch (error) {
    console.log(error);
    res.status(500).send({
      success: false,
      message: "Error in CREATE STUDENT",
      error,
    });
  }
};

//UPDATE STUDENT
const updateStudent = async (req, res) => {
  try {
    const studentId = req.params.id;
    if (!studentId) {
      return res.status(404).send({
        success: false,
        message: "INVALID or PROVIDE STUDENT ID",
      });
    }

    const { name, roll_no, class_, medium, fees } = req.body;
    //Validate

    const data = await db.query(
      `UPDATE students SET name = ?, roll_no = ?, class_ = ?, medium = ?, fees = ? WHERE id = ?`,
      [name, roll_no, class_, medium, fees, studentId]
    );
    if (!data) {
      return res.status(404).send({
        success: false,
        message: "Error in UPDATE STUDENT API",
      });
    }
    res.status(200).send({
      success: true,
      message: "student details updated to record",
      totalStudents: data[0].length,
      data: data[0],
    });
  } catch (error) {
    console.log(error);
    res.status(500).send({
      success: false,
      message: "Error in UPDATE STUDENT API",
      error,
    });
  }
};

//DELETE STUDENT
const deleteStudent = async (req, res) => {
  try {
    const studentId = req.params.id;
    if (!studentId) {
      return res.status(404).send({
        success: false,
        message: "INVALID or PROVIDE STUDENT ID",
      });
    }

    await db.query(
      `DELETE FROM students WHERE id = ?`,
      [studentId]
      //   (err, rows, fields) => {
      //     if (err) throw err;
      //     res.redirect("/");
      //   }
    );
    res.status(200).send({
      success: true,
      message: "student removed successfully",
    });
  } catch (error) {
    console.log(error);
    res.status(500).send({
      success: false,
      message: "Error in DELETE STUDENT API",
      error,
    });
  }
};

module.exports = {
  getStudents,
  getStudentById,
  createStudent,
  updateStudent,
  deleteStudent,
};
