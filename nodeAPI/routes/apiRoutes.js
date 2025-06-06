const express = require("express");

const router = express.Router();
const { NITDB } = require("../config/db.js");
const nodemailer = require("nodemailer");
const constents = require("../config/constents.js");
const { ObjectId } = require("mongodb");

router.post("/register", async (req, res) => {
  const nitDB = NITDB();

  const data = req.body.data;
  console.log("data-->", data);

  let error = false;
  let msg = "";

  // Validation...
  console.log("constents-->", constents, typeof constents);

  console.log("length of address -->", typeof data.address);
  console.log(
    "name-->",
    data.name,
    "email-->",
    data.email,
    "phone-->",
    data.phone,
    "length-->",
    data.phone.toString().length,
    "type of ",
    typeof data.phone,
    "adrs-->",
    data.address,
    "gender-->",
    data.gender,
    "program-->",
    data.program
  );

  if (!constents.regexForName.test(data.name)) {
    error = true;
    msg = "Invalid Name..!!";
  } else {
    data.name = formatName(data.name);
  }
  if (isNaN(Number(data.phone)) || data.phone.toString().length != 10) {
    error = true;
    msg = "Invalid Phone No..!!";
  }
  if (!constents.emailRegex.test(data.email)) {
    error = true;
    msg = "Invalid E-mail address..!!";
  }
  // if (userOtp != orgOtp) {
  //   error = true;
  //   msg = "Invalid OTP..!!";
  // }
  if (data.address.length > 30) {
    error = true;
    msg = "Too Lengthy Address..!!";
  }
  if (data.gender != "M" && data.gender != "F") {
    error = true;
    msg = "Please Select a Gender..!!";
  }
  if (
    !data.name ||
    !data.email ||
    !data.phone ||
    !data.address ||
    !constents.SUBARR.includes(data.program)
  ) {
    error = true;
    msg = "Invalid or Empty Field Passed..!!";
  }

  // Validation Completed.....

  if (error == true) {
    return res.json({
      status: "error",
      message: msg,
      code: 500,
    });
  } else {
    data.status = 0;
  }
  if (error == false) {
    inserted = await nitDB.collection("studentLead").insertOne(data);
    console.log("inserted-->", inserted);

    if (inserted?.acknowledged) {
      // mail to Registered student..
      const transporter = nodemailer.createTransport({
        service: "Gmail",
        auth: {
          user: "nitcgl.fullsuportportal@gmail.com",
          pass: "sift agct rfjo mgbm",
        },
      });

      const mailOptions = {
        from: "nitcgl.fullsuportportal@gmail.com",
        to: data.email,
        subject: `Welcome TO NIT ,${data.name}`,
        text: `Dear ${data.name},
                Thank you for registering with NIT College.Your registration has been successfully received. A counselor will contact you shortly to guide you through the next steps.
                If you have any questions in the meantime, feel free to reply to this email.

                Best regards,  
                NIT College Admissions Team.
                `,
      };

      transporter.sendMail(mailOptions, (error, info) => {
        if (error) {
          console.log("Error sending mail:", error);
        }
        console.log("Email sent:", info.response);
        if (info.response) {
          console.log("E-mail send successfully..!!");
        }
      });
      // Mail Done....

      return res.json({
        status: "success",
        message: "Registered successfully..",
        code: 200,
      });
    } else {
      return res.json({
        status: "error",
        message: "Internal Server Error..!!",
        code: 500,
      });
    }

    // status for lead --> 0 no call , 1 interested , 2 not interested , 3 enrolled (in constent file)

    // res.send("working fine...");
  }
});

router.post("/sendOTP", async (req, res) => {
  const data = req.body;

  console.log("data-->", data);

  const transporter = nodemailer.createTransport({
    service: "Gmail",
    auth: {
      user: "nitcgl.fullsuportportal@gmail.com",
      pass: "sift agct rfjo mgbm",
    },
  });

  const mailOptions = {
    from: "nitcgl.fullsuportportal@gmail.com",
    to: data.email,
    subject: `Your OTP Code is : ${data.otp}`,
    text: `Here is your OTP for E-mail Verification : ${data.otp}`,
  };

  transporter.sendMail(mailOptions, (error, info) => {
    if (error) {
      return console.log("Error sending mail:", error);
    }
    console.log("Email sent:", info.response);
    if (info.response) {
      return res.json({
        status: "success",
        message: "OTP Sent SuccessFully..",
        code: 200,
      });
    } else {
      return res.json({
        status: "error",
        message: "Server Bussy..!!",
        code: 200,
      });
    }
  });
});

router.post("/addStudent", async (req, res) => {
  const nitDB = NITDB();

  const data = req.body.data;
  const id = req.body.sid;
  console.log("data-->", data);

  let error = false;
  let msg = "";

  // validation...
  if (!constents.regexForName.test(data.name)) {
    error = true;
    msg = "Invalid Name..!!";
  } else {
    data.name = formatName(data.name);
  }

  console.log("phone type of --->", typeof data.phone);

  if (isNaN(Number(data.phone)) || data.phone.toString().length != 10) {
    error = true;
    msg = "Invalid Phone No..!!";
  } else {
    data.phone = data.phone.toString();
  }
  if (!constents.emailRegex.test(data.email)) {
    error = true;
    msg = "Invalid E-mail address..!!";
  }
  if (data.address.length > 30) {
    error = true;
    msg = "Too Lengthy Address..!!";
  }
  if (data.gender != "M" && data.gender != "F") {
    error = true;
    msg = "Please Select a Gender..!!";
  }
  console.log(typeof data.status, data.status);

  if (Number(data.status) != 3 && Number(data.status) != 1) {
    error = true;
    msg = "Invalid Enrollment";
  }
  if (!constents.regexForName.test(data.father)) {
    error = true;
    msg = "Invalid Father's Name";
  } else {
    data.father = formatName(data.father);
  }
  if (!constents.regexForName.test(data.mother)) {
    error = true;
    msg = "Invalid Mother's Name";
  } else {
    data.mother = formatName(data.mother);
  }
  if (
    !data.name ||
    !data.email ||
    !data.phone ||
    !data.gender ||
    !data.address ||
    !data.father ||
    !data.mother ||
    !data.qualification ||
    !data.status ||
    !constents.SUBARR.includes(data.program)
  ) {
    error = true;
    msg = "Invalid or Empty Field Passed..!!";
  }
  // validation completed...

  if (error == true) {
    return res.json({
      status: "error",
      message: msg,
      code: 500,
    });
  }
  if (error == false) {

    const exists = await nitDB.collection.findOne({ _id: ObjectId(id) }) !== null; // true or false
    console.log("exists value -- >",exists);
    

    console.log("data before inserting..", data);
    
    let inserted ;
    if(exists == false){

      inserted = await nitDB.collection("student").insertOne(data);
      console.log("inserted-->", inserted);
    }else{
      
      inserted = await nitDB.collection("student").updateOne({_id:id}, {$set:data}, {$upsert:true});
      console.log("upserted -->", upserted);
    }

    if (inserted?.acknowledged) {
    
      if(!exists){
        // mail to Registered student..
        const transporter = nodemailer.createTransport({
          service: "Gmail",
          auth: {
            user: "nitcgl.fullsuportportal@gmail.com",
            pass: "sift agct rfjo mgbm",
          },
        });

        const mailOptions = {
          from: "nitcgl.fullsuportportal@gmail.com",
          to: data.email,
          subject: `Welcome TO NIT ,${data.name}`,
          text: `Dear ${data.name},

                  Congratulations! We are pleased to inform you that you have been successfully enrolled at NIT College.

                  We are excited to welcome you into our academic community. Your journey toward excellence starts here, and we are committed to supporting you every step of the way.

                  You will receive further information regarding your classes, orientation, and next steps shortly.

                  If you have any questions, feel free to contact us at any time.

                  Best regards,
                  NIT College Admissions Team. `,
        };

        transporter.sendMail(mailOptions, (error, info) => {
          if (error) {
            console.log("Error sending mail:", error);
          }
          console.log("Email sent:", info.response);
          if (info.response) {
            console.log("E-mail send successfully..!!");
          }
        });
        // Mail Done....
      }

      return res.json({
        status: "success",
        message: "Student Enrolled..!!",
        code: 200,
      });
    } else {
      return res.json({
        status: "error",
        message: "Internal Server Error..!!",
        code: 500,
      });
    }
  }
});

router.post("/studentList", async (req, res) => {
  console.log("in leads api");

   const nitDB = NITDB();
   const id = req.body?.id || ""; 
   const page = req.body?.page || "all";

    console.log("id-->",id,"page-->", page);
    if(page == "lead"){
      if(id){
        let detail = await nitDB
          .collection("studentLead")
          .find({_id :new ObjectId(id)})
          .toArray();

        return res.json({
          status:"success",
          detail,
          code:200
        })
      }else{
        let leads = await nitDB.collection("studentLead").find({}).toArray();
          return res.json({
            status: "success",
            leads,
            code: 200,
          });
      }
    }

      else if(page == "all"){
      if(id){
        let detail = await nitDB
          .collection("student")
          .find({_id :new ObjectId(id)})
          .toArray();

        return res.json({
          status:"success",
          detail,
          code:200
        })
      }else{
        let leads = await nitDB.collection("student").find({}).toArray();
          return res.json({
            status: "success",
            leads,
            code: 200,
          });
      }
    }
    else{
       return res.json({
            status: "error",
            message:"Invalid API Call",
            code: 200,
          });
    }

 
});

router.post("/filter", async (req, res) => {
  console.log("in filter leads api");

  let filterData = req.body.FILTERDATA || {};
  const page = req.body.page || "";
  let error = false;
  let msg = "";
  let filterQuery = {};

  const collection = page == "all"?"student":"studentLead"

  const nitDB = NITDB();
  if (filterData.lenggth < 1) {
    error = true;
    msg = "No Filter Provided..!!";
  }
  if (filterData?.email) filterQuery.email = filterData.email;
  if (filterData?.name) filterQuery.name = filterData.name;
  if (filterData?.gndr) filterQuery.gender = filterData.gndr;
  if (filterData?.phone) filterQuery.phone = filterData.phone;
  if (filterData?.program) filterQuery.program = filterData.program;

  console.log("filter query -- >", filterQuery, "filterData ->", filterData);

  if (error == false) {
    let leads = await nitDB
      .collection(collection)
      .find(filterQuery)
      .toArray();

    return res.json({
      status: "success",
      leads,
      code: 200,
    });
  }
});

router.post("/delete",async (req,res) =>{
  

  const nitDB = NITDB();
  const data = req.body;
  let error = false;
  let msg = "";

  const collection = data.page == "all"?"student":"studentLead"

  if(!data.id){
  error = true;
  msg = "User Invalid..!!";
  }

  if(error == true){
     return res.json({status:"error",
            message:msg,
            code:200,
          });
  }

 if (error == false) {
    let deleted = await nitDB
      .collection(collection)
      .deleteOne({_id :new ObjectId(data.id)})

  console.log("deleted-->",deleted);
  

      if(deleted.acknowledged && deleted.deletedCount > 0){
      return  res.json({status:"success",
            message:"data deleted successfully.",
            code:200,
          });
      }else{
      return res.json({status:"error",
            message:"Someting Went Wrong",
            code:200,
          });
      }
  
  }
 
})

router.post("/statusUpdate",async (req,res) => {

  console.log("api called for update status");
  
  const nitDB = NITDB();
  const data = req.body;
  console.log("logg-->",data);

  let error = false;
  let msg = "";

  if(!data?.id){
    error = true;
    msg = "Invlaid Information..!!";
  }
   if(!data?.status || data.status > 3 || data.status < 0){
    error = true;
    msg = "Invlaid Information..!!";
  }
  console.log("checking -->data?.page ",data?.page ,`data?.page && (data.page == "all" || data.page == "lead")-->`,data?.page && (data.page == "all" || data.page == "lead"));
  
  if(!data?.page || data.page != "all" && data.page != "lead"){
    console.log("in error condition");
    
     error = true;
     msg="Invalid Information..!!";
  }
  
  if(error == true){
    return res.json({
      status : "error",
      message:msg,
      code:500,
    })
  }
  if(error == false){

    let inserted ;
      
    if(data.page == "lead"){
      inserted = await nitDB.collection("studentLead").updateOne(
        { _id: new ObjectId(data.id) }, 
        {
          $set: {
            status : data.status,
          }
        },
        { upsert: true }
      )}
    
    if(data.page == "all"){
      inserted = await nitDB.collection("student").updateOne(
        { _id:new ObjectId(data.id) }, 
        {
          $set: {
            status : data.status,
          }
        },
        { upsert: true }
      )}
    
  if(inserted?.acknowledged){
    return res.json({
      status : "success",
      message:"Status Updated..!!",
      code:200,
    })
  }

  }
  
})

function formatName(name) {
  return name
    .toLowerCase()
    .split(" ")
    .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
    .join(" ");
}
module.exports = router;
 