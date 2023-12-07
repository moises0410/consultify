function sendMail() {
    var params = {
      stud: document.getElementById("stud").value,
      email: document.getElementById("email").value,
      prof: document.getElementById("prof").value,
      time: document.getElementById("time").value,
      date: document.getElementById("date").value,
    };
  
    const serviceID = "service_v004ctl";
    const templateID = "template_4r6rlck";
  
      emailjs.send(serviceID, templateID, params)
      .then(res=>{
          document.getElementById("stud").value = "";
          document.getElementById("email").value = "";
          document.getElementById("prof").value = "";
          document.getElementById("date").value = "";
          document.getElementById("time").value = "";
          console.log(res);
          alert("Your email sent successfully!!")
  
      })
      .catch(err=>console.log(err));
  
  }