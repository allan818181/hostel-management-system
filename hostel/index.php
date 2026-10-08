<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>

        
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    line-height: 1.6;
    color: teal;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
}

/* Header */
.header {
    background: #007BFF;
    color: white;
    padding: 15px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 1000;
}

.header .logo {
    font-size: 1.8rem;
    font-weight: bold;
}

.header .logo span {
    color: #00c6ff;
}

.nav ul {
    list-style: none;
    display: flex;
    gap: 20px;
}

.nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 1rem;
    font-weight: bold;
}

/* Hero Section */
.hero {
    background: linear-gradient(to right, #007BFF, #00c6ff);
    color: white;
    text-align: center;
    padding: 100px 20px;
}

.hero h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 30px;
}

.cta-buttons .btn {
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 1rem;
    margin: 0 10px;
    display: inline-block;
}

.cta-buttons .btn {
    background: #0056b3;
    color: white;
    border: none;
}

.cta-buttons .btn.secondary {
    background: white;
    color: #0056b3;
    border: 1px solid #0056b3;
}


.features {
    background: #f4f4f4;
    padding: 60px 20px;
    text-align: center;
}

.features h2 {
    font-size: 2rem;
    margin-bottom: 40px;
}

.feature-cards {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.feature-card {
    background: white;
    padding: 20px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    width: 300px;
    text-align: left;
}


.testimonials {
    background: #007FFF;
    color: white;
    padding: 60px 20px;
    text-align: center;
}

.testimonials h2 {
    font-size: 2rem;
    margin-bottom: 40px;
}

.testimonial-cards {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.testimonial-card {
    background: white;
    color: #333;
    padding: 20px;
    border-radius: 8px;
    width: 300px;
    text-align: center;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

/* Footer */
.footer {
    background: #333;
    color: white;
    text-align: center;
    padding: 15px 0;
}

    </style>
    <!-- Header Section -->
    <header class="header">
        <div class="container">
            <h1 class="logo">Hostel<span>Connect</span></h1>
            <nav class="nav">
                <ul>
                    <!-- <li><a href="student/register.php">Register</a></li>
                    <li><a href="student/login.php">Login</a></li> -->
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Find Your Perfect Stay!</h1>
            <p>Your journey to comfort begins here. Book your hostel with ease and flexibility.</p>
            <div class="cta-buttons">
                <a href="student/register.php" class="btn">Get Started</a>
                <a href="student/login.php" class="btn secondary">Login</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2>Why Choose Us?</h2>
            <div class="feature-cards">
                <div class="feature-card">
                    <h3>Seamless Booking</h3>
                    <p>Reserve your room in just a few clicks with our easy-to-use booking system.</p>
                </div>
                <div class="feature-card">
                    <h3>Comfortable Rooms</h3>
                    <p>Choose from a variety of rooms designed to meet your needs and budget.</p>
                </div>
                <div class="feature-card">
                    <h3>24/7 Support</h3>
                    <p>Our team is always here to assist you with any queries or concerns.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2>What Our Customers Say</h2>
            <div class="testimonial-cards">
                <div class="testimonial-card">
                    <p>"The booking process was so simple! Highly recommend HostelConnect."</p>
                    <span>- charmy.</span>
                </div>
                <div class="testimonial-card">
                    <p>"Great service and comfortable rooms. My stay was amazing!"</p>
                    <span>- Bunny.</span>
                </div>
                <div class="testimonial-card">
                    <p>"Very affordable and user-friendly system. Booking made easy."</p>
                    <span>- Ammy.</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 HostelConnect. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
