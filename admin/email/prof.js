function sendMail() {
    var params = {
      name: document.getElementById("name").value,
      email: document.getElementById("email").value,
      sname: document.getElementById("sname").value,
      time: document.getElementById("time").value,
      date: document.getElementById("date").value,
      message: document.getElementById("message").value,
    };
  
    const serviceID = "service_ih9rlwa";
    const templateID = "template_nyvh3px";
  
      emailjs.send(serviceID, templateID, params)
      .then(res=>{
          document.getElementById("name").value = "";
          document.getElementById("email").value = "";
          document.getElementById("sname").value = "";
          document.getElementById("date").value = "";
          document.getElementById("time").value = "";
          document.getElementById("message").value = "";
          console.log(res);
          alert("Your email sent successfully!!")
  
      })
      .catch(err=>console.log(err));
  
  }