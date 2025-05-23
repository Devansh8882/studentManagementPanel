const { MongoClient } = require("mongodb");

const connectiontring = "mongodb://localhost:27017";
const client = new MongoClient(connectiontring);

let db;

async function connectDB() {
  try {
    await client.connect();
    db = client.db("NIT-COLLEGE");
    console.log(" MongoDB connected.");
  } catch (err) {
    console.error(" MongoDB connection failed:", err);
  }
}

function NITDB() {
  if (!db) throw new Error(" DB not initialized");
  return db;
}

module.exports = { connectDB, NITDB };
