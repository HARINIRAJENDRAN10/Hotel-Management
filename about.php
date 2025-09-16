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
        body, #home {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #home {
            width: 100%;
            background-color: aquamarine;
        }

        .roww {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
            height: auto;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        .images {
            width: 40%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .images img {
            width: 90%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: block;
        }

        .contents {
            width: 50%;
            padding: 20px;
            text-align: justify;
        }

        .contents pre {
            font-size: 18px;
            line-height: 1.4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            white-space: normal;
            margin: 0;
        }

        .contents a {
            display: inline-block;
            margin-top: 15px;
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
        }

        .contents a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <section id="home">
        <div class="roww">
            <div class="images">
                <img src="saffron.jpg" alt="Saffron Restaurant">
            </div>
            <div class="contents">
                <pre>
Saffron Restaurant is a multi cuisine restaurant for fine dining in Rajapalayam.  
Restaurant serves world popular food items, North Indian & South Indian food created carefully to satisfy your taste.  
Air conditioned with good ambience dining hall is the best place in Rajapalayam to relish good food with your family and friends. 
Saffron Restaurant caters buffet for events and meeting. 
                </pre>
                <a href="tel:+914563233600">For Food Delivery call +91-4563-233600</a>
            </div>
        </div>
    </section>

    <div style="text-align:center; margin:2rem auto; max-width:600px; position:relative;">
        <img id="sliderImage" src="pic1.jpg" style="width:100%; height:auto; border-radius:8px;">
    </div>
    <script>
        let images = ['pic1.jpg', 'pic2.jpg', 'pic3.jpg'];
        let index = 0;
        setInterval(() => {
            index = (index + 1) % images.length;
            document.getElementById('sliderImage').src = images[index];
        }, 3000);
    </script>
    
</body>
<?php include("footer.html"); ?>
