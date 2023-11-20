<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .booking-form {
            display: none;
            padding: 15px;
            border: 1px solid #ddd;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<table id="timeslot-table">
    <thead>
        <tr>
            <th>Time Slot</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td data-time="9:00 AM - 9:30 AM">9:00 AM - 9:30 AM</td>
        </tr>
        <tr>
            <td data-time="10:00 AM">10:00 AM</td>
        </tr>
        <tr>
            <td data-time="11:00 AM">11:00 AM</td>
        </tr>
        <!-- Add more time slots as needed -->
    </tbody>
</table>

<div id="booking-form" class="booking-form">
    <h2>Booking Form</h2>
    <!-- Add your booking form fields here -->
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <!-- Add more form fields as needed -->
    <button onclick="submitBooking()">Submit Booking</button>
</div>

<script>
    var bookingForm = document.getElementById('booking-form');
    var timeSlots = document.querySelectorAll('#timeslot-table tbody td');

    timeSlots.forEach(function(timeSlot) {
        timeSlot.addEventListener('click', function() {
            // Hide all booking forms
            document.querySelectorAll('.booking-form').forEach(function(form) {
                form.style.display = 'none';
            });

            // Show the booking form corresponding to the clicked time slot
            bookingForm.style.display = 'block';
        });
    });

    function submitBooking() {
        // Add logic to handle form submission
        alert('Booking submitted!');
    }
</script>

</body>
</html>
