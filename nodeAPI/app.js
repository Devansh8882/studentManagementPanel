const { connectDB } = require("./config/db");
const express = require("express");
const cors = require("cors");

const bodyParser = require("body-parser");
const apiRoutes = require("./routes/apiRoutes.js");

const app = express();
const PORT = 3000;

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true })); // for form data

// console.log("log111");

// Start server after DB connection

connectDB().then(() => {
  app.listen(PORT, () => {
    console.log(` Server running at PORT No. -> ${PORT}`);
  });
});

app.use(
  cors({
    origin: "http://localhost",
    methods: ["GET", "POST", "PUT", "DELETE"],
    credentials: true,
  })
);

// console.log("log222");

// Routes
app.use("/v1", apiRoutes);
