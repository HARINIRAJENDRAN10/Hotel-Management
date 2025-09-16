<?php include("header.html") ?>
<head>

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
</style>

    <style>
        .map-container {
            text-align: center;
            margin-top: 20px;
        }

        iframe {
            width: 90%;
            height: 450px;
            border: none;
            border-radius: 8px;
        }

        pre.coordinates {
            font-size: 16px;
            color: #3f51b5;
            font-weight: bold;
            margin-top: 15px;
            white-space: pre-wrap;
            /* centers the pre text */
            text-align: center;
        }

        .contact-section {
            display: flex;
            justify-content: center;
            gap: 80px;
            padding: 50px 20px;
            background-color: #f9f9f9;
            flex-wrap: wrap;
        }

        .contact-column {
            max-width: 400px;
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .contact-column h2 {
            color: #3f51b5;
            margin-bottom: 20px;
        }

        .contact-column b {
            display: inline-block;
            margin-top: 15px;
            color: #000;
        }

        .contact-column p {
            margin: 5px 0;
        }

        @media (max-width: 768px) {
            .contact-section {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <div class="map-container">
    
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3935.85588928232!2d77.5264004!3d9.434035999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a54a89e617b94ab%3A0x706fd2d2183a8418!2sHotel%20Amil!5e0!3m2!1sen!2sin!4v1748791426070!5m2!1sen!2sin" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div class="contact-section">
        <div class="contact-column">
            <h2>Contact Us</h2>
            <p><b>Hotel Amil</b><br>
            259-A, Tenkasi Main Road,<br>
            Rajapalayam – 626142<br>
            Virudhunagar District,<br>
            Tamil Nadu, India.</p>

            <p><b>Grievance Redressal</b><br>
            <b>Mobile:</b> +91 8111007108<br>
            <b>Email:</b> info@hotelamil.com</p>
        </div>

        <div class="contact-column">
            <h2>&nbsp;</h2> 
            <p><b>Reservations and Sales:</b><br>
            <b>Phone:</b> +91 4563 233600<br>
            <b>Mobile:</b> +91 7867094947<br>
            <b>Email:</b> reservation@hotelamil.com</p>
        </div>
    </div>

<?php include("footer.html") ?>

    <div style="text-align:center; padding: 2rem;">
        <h2>Find Us</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.449558118538!2d78.14802501462268!3d10.788753992310586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b00669fb4d5474d%3A0x30141c23fc180ba7!2sHotel%20Amil!5e0!3m2!1sen!2sin!4v1719149345881!5m2!1sen!2sin" 
        width="90%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    