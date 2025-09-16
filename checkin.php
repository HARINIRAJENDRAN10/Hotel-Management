<?php include("header.html") ?>
<head>
    <style>
        /* Existing CSS remains unchanged */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body::before {
    content: "";
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: url('hotel_view.jpg') no-repeat center center fixed;
    background-size: cover;
    z-index: -1;
    animation: bgmove 20s linear infinite;
    opacity: 0.2;
}

        form {
            margin: 50px auto;
            width: 400px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px gray;
        }

        table {
            width: 100%;
        }

        td {
            padding: 10px;
            color: black;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        input[type="time"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid black;
            border-radius: 4px;
            background-color: lightyellow;
        }

        input[readonly] {
            background-color: #e6ffe6;
        }

        input[type="submit"] {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>

<form id="bookingForm" action="payment.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Name</td>
            <td><input type="text" name="name" id="name" required></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="email" id="email" required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" id="password" required></td>
        </tr>
        <tr>
            <td>Date of Birth</td>
            <td><input type="date" name="dob" id="dob" required></td>
        </tr>
        <tr>
            <td>ID Proof</td>
            <td><input type="file" name="idproof" id="idproof" accept="application/pdf" required></td>
        </tr>
        <tr>
            <td>Check-in Date</td>
            <td><input type="date" name="checkdate" id="checkdate" required></td>
        </tr>
        <tr>
            <td>Check-in Time</td>
            <td><input type="time" name="checkin" id="checkin" required></td>
        </tr>
        <tr>
            <td>No. of Days Staying</td>
            <td><input type="text" name="noofdays" id="noofdays" required></td>
        </tr>
        <tr>
            <td>Type of Room</td>
            <td>
                <select name="roomtype" id="roomtype" required>
                    <option value="">Select</option>
                    <option value="Deluxe">Deluxe</option>
                    <option value="Executive Single">Executive Single</option>
                    <option value="Family Room">Family Room</option>
                </select>
            </td>
        </tr>
         <tr>
            <td>No.of rooms</td>
            <td>
               <input type="text" name="rooms" id="rooms" required>
            </td>
        </tr>
        <tr>
            <td>Total Amount (₹)</td>
            <td><input type="text" id="amount" name="amount" readonly></td>
        </tr>
        <tr>
            <td>Checkout Date</td>
            <td><input type="text" id="checkoutdate" name="checkoutdate" readonly></td>
        </tr>
        <tr>
            <td>Checkout Time</td>
            <td><input type="time" id="checkouttime" name="checkouttime" readonly></td>
        </tr>
    </table>
    <input type="submit" name="button" value="Submit and Proceed to Pay">
</form>

<script>
    const prices = {
        "Deluxe": 4000,
        "Executive Single": 3000,
        "Family Room": 5000
    };

    function calculateFields() {
        const days = parseInt(document.getElementById("noofdays").value);
        const roomType = document.getElementById("roomtype").value;
        const checkinTime = document.getElementById("checkin").value;
        const checkdate=document.getElementById("checkdate").value;
        const amountField = document.getElementById("amount");
        const checkoutDateField = document.getElementById("checkoutdate");
        const checkoutTimeField = document.getElementById("checkouttime");

        if (!isNaN(days) && days > 0 && roomType) {
            amountField.value = prices[roomType] * days;

            const today = new Date();
            const checkinDate = new Date(checkdate);
            const checkoutDate = new Date(checkinDate);
            checkoutDate.setDate(checkinDate.getDate() + days);
            const yyyy = checkoutDate.getFullYear();
            const mm = String(checkoutDate.getMonth() + 1).padStart(2, '0');
            const dd = String(checkoutDate.getDate()).padStart(2, '0');
            checkoutDateField.value = `${yyyy}-${mm}-${dd}`;
        } else {
            amountField.value = "";
            checkoutDateField.value = "";
        }

        if (checkinTime) {
            checkoutTimeField.value = checkinTime;
        } else {
            checkoutTimeField.value = "";
        }
    }

    document.getElementById("noofdays").addEventListener("input", calculateFields);
    document.getElementById("roomtype").addEventListener("change", calculateFields);
    document.getElementById("checkin").addEventListener("input", calculateFields);

    // Enhanced form validation & alert
    document.getElementById("bookingForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        const dob = document.getElementById("dob").value;
        const idproof = document.getElementById("idproof").files[0];
        const checkin = document.getElementById("checkin").value;
        const noofdays = document.getElementById("noofdays").value;
        const roomtype = document.getElementById("roomtype").value;

        // Username validation: letters only
        const namePattern = /^[A-Za-z\s]+$/;
        if (!namePattern.test(name)) {
            alert("❌ Name should contain letters only, no numbers or special characters.");
            return;
        }

        // Password validation: <=8 chars, letters/numbers/underscore
        const passwordPattern = /^\w{1,8}$/;
        if (!passwordPattern.test(password)) {
            alert("❌ Password must be <=8 characters and can include letters, numbers, or underscore only.");
            return;
        }

        // Email validation: simple pattern for gmail, yahoo, outlook
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|in|net|org)$/;
        if (!emailPattern.test(email)) {
            alert("❌ Please enter a valid email address (e.g., name@gmail.com).");
            return;
        }

        // Other fields validation
        if (!dob || !idproof || !checkin || !noofdays || !roomtype) {
            alert("❌ Please fill in all required fields.");
            return;
        }

        // Numeric check for noofdays
        if (isNaN(noofdays) || noofdays <= 0) {
            alert("❌ Number of days must be a valid number greater than 0.");
            return;
        }

        // If all validations pass, show success alert
        alert(`🎉 Congratulations ${name}! Your room has been booked successfully! Enjoy your stay at Hotel Amil 🏨`);

        // Submit the form after alert
        this.submit();
    });
</script>

</body>
<?php include("footer.html") ?>
