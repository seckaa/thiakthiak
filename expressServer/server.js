const colors = require("colors");
const express = require("express");
const morgan = require("morgan");
const dotenv = require("dotenv");

const mySqlPool = require("./config/db");

const multer = require("multer");
const fs = require("fs");
// const db = require("./config/db");
const path = require("path");

//configured dotenv
dotenv.config();

//image
// Create the uploads directory if it doesn't exist
const uploadDir = "uploads";
if (!fs.existsSync(uploadDir)) {
  fs.mkdirSync(uploadDir);
}

// const upload = multer({ storage: multer.memoryStorage() });//to get a buffer for non local storage

//rest object
const app = express();

//middlewares
// Set up Multer to handle file uploads
const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    cb(null, uploadDir);
  },
  filename: (req, file, cb) => {
    if (!file.originalname.existsSync) {
      const uniqueSuffix = Date.now() + "-" + Math.round(Math.random() * 1e9);
      // const charArray = file.originalname.split(".");
      // const lastChar = charArray.pop();
      cb(
        null,
        file.fieldname +
          "-" +
          uniqueSuffix +
          "." +
          path.extname(file.originalname)
      );
      // cb(null, file.originalname);
    }
  },
});
const upload = multer({
  storage: storage,
  limits: {
    fileSize: 1024 * 1024 * 2,
  },
  fileFilter: (req, file, cb) => {
    const fileTypes = /jpeg|png|jpg|gif|webp/; // Regular expression
    const extname = fileTypes.test(
      path.extname(file.originalname).toLowerCase()
    );
    const mimetype = fileTypes.test(file.mimetype);

    if (extname && mimetype) {
      cb(null, true);
    } else {
      cb(new Error("Images only!"));
    }
  },
});

app.use(morgan("dev"));
app.use(express.json());
app.use(express.static(__dirname));

//routes
app.use("/api/v1/student", require("./routes/studentRoutes"));

app.post("/upload", upload.single("file"), (req, res) => {
  //   //   image = req.file.buffer.toString("base64");
  //   img_url = req.file.path;
  //   // Read the file and convert it to binary data
  //   image = fs.readFileSync(img_url);
  //   console.log("upload", image, "path", img_url);
  //   //save to db
  //   query = `INSERT INTO students (name, roll_no, class_, medium, fees,image,img_url) VALUES (?,?,?,?,?,?,?)`;
  //   db.query(
  //     query,
  //     ["Adam", 4, 10, "english", 1400, image, img_url],
  //     (err, rows, fields) => {
  //       if (err) throw err;
  //       res.redirect("/");
  //     }
  //   );
  // // Read a file asynchronously
  //   fs.readFile(
  //     "uploads/8e90b8ba5cf712dde43179871b3d9513e884d66e-412x606.webp",
  //     "utf8",
  //     (err, data) => {
  //       if (err) {
  //         console.error(err);
  //         return;
  //       }
  //       console.log(data);
  //     }
  //   );
  // Write to a file asynchronously
  //   fs.writeFile("path_to_your_file.txt", "Hello, world!", "utf8", (err) => {
  //   fs.writeFile(image, "Hello, world!", "utf8", (err) => {
  //     if (err) {
  //       console.error(err);
  //       return;
  //     }
  //     console.log("File has been saved!");
  //   });

  res.json(req.file);
});
app.post("/upload-1", upload.single("file"), (req, res) => {
  if (!req.file) {
    return res.status(400).send({
      success: false,
      message: "No file uploaded",
    });
  }
  res.status(200).send({
    success: true,
    message: `File uploaded : ${req.file.filename}`,
  });
  // res.json(req.file);
});

app.post("/upload-multiple", upload.array("files", 4), (req, res) => {
  //4 is the limit
  if (!req.files) {
    return res.status(400).send({
      success: false,
      message: "No file uploaded",
    });
  }
  res.status(200).send({
    success: true,
    message: `Files uploaded :${req.files.map((file) => file.filename)}`,
  });
  // res.json(req.file);
});
app.get("/", (req, res) => {
  res.sendFile(path.join(__dirname, "index.html"));
});

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
