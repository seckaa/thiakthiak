const colors = require("colors");
const express = require("express");
const morgan = require("morgan");
const dotenv = require("dotenv");
const cors = require("cors");

const mySqlPool = require("./config/db");

const multer = require("multer");
const fs = require("fs");
// const db = require("./config/db");
const path = require("path");
const crypto = require("crypto");

//configured dotenv
dotenv.config();

//image
// Create the uploads directory if it doesn't exist
const uploadDir = "uploads";
if (!fs.existsSync(uploadDir)) {
  fs.mkdirSync(uploadDir);
}
// Function to calculate hash of the file content
const calculateFileHash = (fileBuffer) => {
  const hash = crypto.createHash("sha256");
  hash.update(fileBuffer);
  return hash.digest("hex");
};

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
      // cb(
      //   null,
      //   file.fieldname + "-" + uniqueSuffix + path.extname(file.originalname)
      // );
      cb(null, file.originalname);
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
// CORS options
const corsOptions = {
  origin: (origin, callback) => {
    const allowedOrigins = ["http://example.com", "http://another-domain.com"];
    const disallowedOrigins = ["http://disallowed-domain.com"];

    if (disallowedOrigins.includes(origin)) {
      callback(new Error("This domain is not allowed by CORS"), false);
    } else if (allowedOrigins.includes(origin) || !origin) {
      callback(null, true);
    } else {
      callback(new Error("Not allowed by CORS"), false);
    }
  },
  optionsSuccessStatus: 200, // Some legacy browsers choke on 204
};
// Use the `cors` middleware with options
app.use(cors(corsOptions));

app.use(morgan("dev"));
app.use(express.json());
app.use(express.static(__dirname));

//routes
app.use("/api/v1/student", require("./routes/studentRoutes"));

app.post("/upload-1", upload.single("file"), (req, res) => {
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

  // // Check for duplicate
  // const fileBuffer = req.file.buffer;
  // const fileHash = calculateFileHash(fileBuffer);
  //   mySqlPool.query('SELECT * FROM students WHERE file_hash = ?', [fileHash], (err, results) => {
  //   if (err) {
  //     return res.status(500).send({
  //       success: false,
  //       message: err.message
  //     });
  //   }
  //   if (results.length > 0) {
  //     return res.status(400).send({
  //       success: false,
  //       message: "Duplicate file detected!",
  //     });
  //   }}
});
app.post("/upload", (req, res, next) => {
  // List existing files in the directory before upload
  const filesBeforeUpload = fs.readdirSync(uploadDir);
  console.log(
    `Existing files in directory before upload: ${filesBeforeUpload}`
  );

  // Proceed with file upload
  upload.single("file")(req, res, (err) => {
    if (err) {
      return res.status(400).send({
        success: false,
        message: err.message,
      });
    }

    if (!req.file) {
      return res.status(400).send({
        success: false,
        message: "No file uploaded",
      });
    }

    const fileBuffer = fs.readFileSync(req.file.path);
    const fileHash = calculateFileHash(fileBuffer);

    console.log(`Uploaded file hash: ${fileHash}`);

    // Check for duplicate files
    for (const file of filesBeforeUpload) {
      const existingFileBuffer = fs.readFileSync(path.join(uploadDir, file));
      const existingFileHash = calculateFileHash(existingFileBuffer);

      console.log(`Existing file hash: ${existingFileHash}`);

      if (fileHash === existingFileHash) {
        console.log(`Duplicate file found: ${file}`);
        // fs.unlinkSync(req.file.path); // Optionally remove the duplicate file
        return res.status(400).send({
          success: false,
          message: "Duplicate file detected",
        });
      }
    }

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

    res.status(200).send({
      success: true,
      message: `File uploaded: ${req.file.filename}`,
    });
  });
});

// app.post("/upload-1", upload.single("file"), (req, res) => {
//   if (!req.file) {
//     return res.status(400).send({
//       success: false,
//       message: "No file uploaded",
//     });
//   }

//   // Check for duplicate files by name
//   const files = fs.readdirSync(uploadDir);
//   console.log(`Existing files in directory: ${files}`);
//   res.json(req.file);

//   const uploadedFileName = req.file.filename;
//   console.log(`Uploaded file name: ${uploadedFileName}`);

//   if (files.includes(uploadedFileName)) {
//     console.log(`Duplicate file found: ${uploadedFileName}`);
//     fs.unlinkSync(req.file.path); // Optionally remove the duplicate file
//     return res.status(400).send({
//       success: false,
//       message: "Duplicate file detected",
//     });
//   }

//   res.status(200).send({
//     success: true,
//     message: `File uploaded: ${uploadedFileName}`,
//   });
// });

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

// app.post("/upload-multiple", upload.array("files", 4), (req, res) => {
//   if (!req.files) {
//     return res.status(400).send({
//       success: false,
//       message: "No files uploaded",
//     });
//   }

//   const duplicateFiles = [];

//   req.files.forEach((file) => {
//     const uploadedFileName = file.filename;
//     console.log(`Uploaded file name: ${uploadedFileName}`);

//     // Check for duplicate files by name
//     const files = fs.readdirSync(uploadDir);
//     if (files.includes(uploadedFileName)) {
//       console.log(`Duplicate file found: ${uploadedFileName}`);
//       duplicateFiles.push(uploadedFileName);
//       fs.unlinkSync(file.path); // Optionally remove the duplicate file
//     }
//   });

//   if (duplicateFiles.length > 0) {
//     return res.status(400).send({
//       success: false,
//       message: `Duplicate files detected: ${duplicateFiles.join(", ")}`,
//     });
//   }

//   res.status(200).send({
//     success: true,
//     message: `Files uploaded: ${req.files.map((file) => file.filename).join(", ")}`,
//   });
// });

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
