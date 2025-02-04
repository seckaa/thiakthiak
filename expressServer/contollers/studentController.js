const db = require("../config/db");

//Get All Students List
const getStudents = async (req, res) => {
  try {
    const data = await db.query(`SELECT * FROM students`);
    if (!data) {
      return res.status(404).send({
        success: false,
        message: "No record found for Get All Students List",
        error,
      });
    }
    res.status(200).send({
      success: true,
      message: "All students records",
      data,
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

module.exports = { getStudents };
