<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .countdown-container {
            text-align: center;
            background-color: #ffffff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #333;
        }
        .countdown {
            display: flex;
            justify-content: space-between;
            max-width: 400px;
            margin: 0 auto;
            font-size: 2rem;
        }
        .countdown div {
            text-align: center;
            margin: 0 10px;
        }
        .countdown span {
            display: block;
            font-size: 1rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="countdown-container">
        <h1>We Are Launching Soon!</h1>
        <div class="countdown">
            <div>
                <span id="days"></span>
                <span>Days</span>
            </div>
            <div>
                <span id="hours"></span>
                <span>Hours</span>
            </div>
            <div>
                <span id="minutes"></span>
                <span>Minutes</span>
            </div>
            <div>
                <span id="seconds"></span>
                <span>Seconds</span>
            </div>
        </div>
    </div>

    <script>
        // Set the launch date (year, month, day, hour, minute, second)
        const launchDate = new Date('2024-08-28T00:00:00').getTime();

        // Update the countdown every second
        const countdown = setInterval(() => {
            const now = new Date().getTime();
            const distance = launchDate - now;

            // Time calculations
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result
            document.getElementById('days').textContent = days;
            document.getElementById('hours').textContent = hours;
            document.getElementById('minutes').textContent = minutes;
            document.getElementById('seconds').textContent = seconds;

            // If the countdown is finished, redirect to the home page
            if (distance < 0) {
                clearInterval(countdown);
                window.location.href = '/'; // Redirect to the home page after launch
            }
        }, 1000);
    </script>
</body>
</html>
