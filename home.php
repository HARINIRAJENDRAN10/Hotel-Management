<?php include "header.html"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome to Hotel Amil</title>

  <style>
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

    @keyframes bgmove {
      0% { background-position: 0% 0%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 100%; }
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .row6 {
      background-color: lightgray;
      padding: 40px 0;
      text-align: center;
    }

    .row6 p {
      font-size: 32px;
      font-weight: bold;
      color: black;
    }

    .row7 {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: white;
      padding: 30px 50px;
      gap: 20px;
      flex-wrap: wrap;
    }

    .picture-container {
      width: 30%;
      min-width: 250px;
    }

    .picture-container img {
      width: 100%;
      height: auto;
      border-radius: 12px;
      box-shadow: 0 4px 12px gray;
    }

    .center-button {
      text-align: center;
      margin-top: 2rem;
    }

    .center-button button {
      padding: 12px 25px;
      font-size: 1rem;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .center-button button:hover {
      background-color: #0056b3;
    }

    #bookingModal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    #bookingModal .modal-content {
      background: white;
      padding: 2rem;
      border-radius: 10px;
      width: 90%;
      max-width: 400px;
      position: relative;
    }

    #bookingModal h2 {
      margin-bottom: 1rem;
      text-align: center;
    }

    #bookingModal form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    #bookingModal input,
    #bookingModal button[type="submit"] {
      padding: 10px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    #bookingModal button[type="submit"] {
      background: #007bff;
      color: white;
      border: none;
    }

    #bookingModal .close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      background: transparent;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
    }

    @media screen and (max-width: 768px) {
      .row7 {
        flex-direction: column;
      }

      .picture-container {
        width: 90%;
      }
    }
  </style>
</head>
<body>

  <div class="row6">
    <p>Welcome to Amil!!</p>
  </div>

  <div class="row7">
    <div class="picture-container">
      <img src="pic3.jpg" alt="Amil Welcome Image">
    </div>
    <div class="picture-container">
      <img src="hotel_view.jpg" alt="Hotel View">
    </div>
    <div class="picture-container">
      <img src="inn.jpg" alt="Inn Image">
    </div>
  </div>

 

  <!-- Modal Booking Form -->
  <div id="bookingModal">
    <div class="modal-content">
      <button class="close-btn" onclick="document.getElementById('bookingModal').style.display='none'">&times;</button>
      <h2>Room Booking</h2>
      <form action="booking.php" method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="date" name="date" required>
        <input type="number" name="guests" placeholder="Number of Guests" required>
        <button type="submit">Submit</button>
      </form>
    </div>
  </div>

</body>
</html>
<?php include "footer.html"; ?>
