<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ADMIN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/email2.css">

    <script src="email/stud.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
    </script>
    <script type="text/javascript">
        (function () {
            emailjs.init("mKzS-1C2eIV80WSWh");
        })();
    </script>
</head>

<body>
    <style>
        h3 {
            text-align: center;
        }
    </style>
    <br>
    <h3> Email Form - Student</h3>
    <div class="main-container">
        <div class="form-container">

            <div class="form-group">
                <h5 for="stud">Student Name</h5>
                <input type="text" class="form-control" id="stud" placeholder="Enter stud name" />
            </div>

            <div class="form-group">
                <h5 for="email">Email</h5>
                <input type="text" class="form-control" id="email" placeholder="Enter email" />
            </div>

            <div class="form-group">
                <h5 for="prof">Professor Name</h5>
                <input type="text" class="form-control" id="prof" placeholder="Enter Professor name" />
            </div>

            <div class="form-group">
                <h5 for="date">Date</h5>
                <input type="date" class="form-control" id="date" placeholder="Enter date" />
            </div>

            <div class="time-container">
                <h5 for="time">Time</h5>
                <input type="text" class="form-control" id="time" placeholder="Enter time" />
            </div>

            <br>
            <button class="btn btn-primary" onclick="sendMail()">Submit</button>
        </div>
    </div>
</body>

</html>