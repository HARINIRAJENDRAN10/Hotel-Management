<?php include("header.html"); ?>
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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: white;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            padding: 40px 20px;
        }

        .room-card {
            background-color: lightgray;
            width: 320px;
            border-radius: 12px;
            box-shadow: 0 4px 10px gray;
            overflow: hidden;
            text-align: center;
            padding-bottom: 20px;
        }

        .room-card img {
            width: 100%;
            height: auto;
        }

        .room-card h3 {
            font-size: 22px;
            color: darkblue;
            margin: 15px 0 10px;
        }

        .room-card ul {
            list-style: none;
            padding: 0 20px;
            text-align: left;
            font-size: 15px;
            color: #333;
        }

        .room-card ul li {
            margin-bottom: 8px;
        }

        @media screen and (max-width: 768px) {
            .room-card {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="room-card">
            <img src="room1.jpg" alt="Family Room">
            <h3>Family Room – ₹8000/night</h3>
            <ul>
                <li>Two extra-large double beds</li>
                <li>Balcony</li>
                <li>Air conditioning</li>
                <li>Private bathroom</li>
                <li>Flat-screen TV</li>
                <li>Free WiFi</li>
                <li>Included: Breakfast</li>
                <li>Included: GST 12%</li>
            </ul>
        </div>

        <div class="room-card">
            <img src="exec_single.jpg" alt="Executive Single Room">
            <h3>Executive Single Room – ₹2000/night</h3>
            <ul>
                <li>Single bed</li>
                <li>Balcony</li>
                <li>Air conditioning</li>
                <li>Private bathroom</li>
                <li>Flat-screen TV</li>
                <li>Free WiFi</li>
                <li>Included: Breakfast</li>
                <li>Included: GST 12%</li>
            </ul>
        </div>

        <div class="room-card">
            <img src="deluxe.jpg" alt="Deluxe Room">
            <h3>Deluxe Room – ₹5000/night</h3>
            <ul>
                <li>One extra-large double bed</li>
                <li>Balcony</li>
                <li>Air conditioning</li>
                <li>Private bathroom</li>
                <li>Flat-screen TV</li>
                <li>Free WiFi</li>
                <li>Included: Breakfast</li>
                <li>Included: GST 12%</li>
            </ul>
        </div>
    </div>
</body>
<?php include("footer.html"); ?>
