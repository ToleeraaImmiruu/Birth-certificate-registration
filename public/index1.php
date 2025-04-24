<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ifaa Bulaa Kebele - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary-color: #6cafb6;
            /* Sky blue */
            --primary-dark: #5F9EA0;
            /* Cadet blue */
            --secondary-color: #3bd7ec;
            /* Powder blue */
            --accent-color: #ADD8E6;
            /* Light blue */
            --light-color: #F0F8FF;
            /* Alice blue */
            --dark-color: #000000;
            /* Steel blue */
            --text-color: #2b0b0b;
            --text-light: #777;
            --white: #fff;
            --gray-light: #f8f8f8;
            --gray-border: #e0e0e0;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            color: var(--text-color);
            line-height: 1.6;
            background-color: var(--light-color);
            overflow-x: hidden;
            padding-top: 70px;
            /* For fixed header */
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            text-align: center;
            font-size: 0.95rem;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline:hover {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .section {
            padding: 80px 0;
        }

        .section-title {
            font-size: 2.2rem;
            margin-bottom: 25px;
            color: var(--dark-color);
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 70px;
            height: 4px;
            background-color: var(--accent-color);
            margin: 15px auto;
        }

        .text-center {
            text-align: center;
        }

        /* Header/Navigation */
        header {
            background-color: var(--white);
            box-shadow: var(--shadow);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            height: 70px;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
        }

        .logo {
            display: flex;
            align-items: center;
            height: 100%;
        }

        .logo img {
            height: 40px;
            margin-right: 12px;
        }

        .logo-text {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .nav-container {
            display: flex;
            align-items: center;
            height: 100%;
        }

        .nav-menu {
            display: flex;
            height: 100%;
        }

        .nav-menu ul {
            display: flex;
            height: 100%;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .nav-item {
            margin: 0 15px;
            position: relative;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-color);
            transition: var(--transition);
            padding: 5px 0;
            display: flex;
            align-items: center;
            height: 100%;
            font-size: 0.95rem;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background-color: var(--primary-color);
            transition: var(--transition);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Language Switcher */
        .language-switcher {
            margin-left: 20px;
            position: relative;
        }

        .language-options {
            display: flex;
            background: var(--gray-light);
            border-radius: 6px;
            padding: 4px;
            height: 36px;
            align-items: center;
            border: 1px solid var(--gray-border);
        }

        .language-btn {
            padding: 6px 12px;
            margin: 0 2px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.85rem;
            transition: var(--transition);
            border: none;
            background: transparent;
            color: var(--text-light);
        }

        .language-btn.active {
            background-color: var(--primary-color);
            color: var(--white);
            font-weight: 500;
        }

        .language-btn:not(.active):hover {
            background-color: #e8e8e8;
            color: var(--text-color);
        }

        /* Auth Buttons */
        .auth-buttons {
            display: flex;
            margin-left: 20px;
            gap: 12px;
        }

        .auth-btn {
            padding: 8px 18px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: var(--transition);
            cursor: pointer;
            border: 2px solid transparent;
        }

        .auth-btn.login {
            background-color: transparent;
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .auth-btn.login:hover {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .auth-btn.signup {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .auth-btn.signup:hover {
            background-color: var(--primary-dark);
        }

        .mobile-menu-btn {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--primary-color);
            margin-left: 15px;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1566438480900-0609be27a4be?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            height: calc(100vh - 70px);
            display: flex;
            align-items: center;
            color: var(--white);
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .hero-title {
            font-size: 3rem;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        /* Services Section */
        .services {
            background-color: var(--white);
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .service-card {
            background-color: var(--light-color);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .service-img {
            height: 200px;
            overflow: hidden;
        }

        .service-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .service-card:hover .service-img img {
            transform: scale(1.1);
        }

        .service-content {
            padding: 25px;
        }

        .service-title {
            font-size: 1.4rem;
            margin-bottom: 15px;
            color: var(--primary-color);
        }

        /* About Section */
        .about {
            background-color: var(--light-color);
        }

        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .about-img {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .about-text h3 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        .about-text p {
            margin-bottom: 15px;
            line-height: 1.7;
        }

        /* Announcements Section */
        .announcements {
            background-color: var(--white);
        }

        .announcements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .announcement-card {
            border: 1px solid var(--gray-border);
            border-radius: 8px;
            overflow: hidden;
            transition: var(--transition);
        }

        .announcement-card:hover {
            box-shadow: var(--shadow);
            transform: translateY(-5px);
        }

        .announcement-date {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 10px 15px;
            font-weight: 500;
        }

        .announcement-content {
            padding: 20px;
        }

        .announcement-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--dark-color);
        }

        /* Contact Section */
        .contact {
            background-color: var(--light-color);
        }

        .contact-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 50px;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .contact-icon {
            font-size: 1.3rem;
            color: var(--primary-color);
            margin-right: 15px;
            margin-top: 5px;
        }

        .contact-details h3 {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .contact-form .form-group {
            margin-bottom: 20px;
        }

        .contact-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--gray-border);
            border-radius: 6px;
            font-size: 1rem;
            transition: var(--transition);
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(135, 206, 235, 0.1);
        }

        .contact-form textarea {
            height: 150px;
            resize: vertical;
        }

        /* Footer */
        footer {
            background-color: var(--dark-color);
            color: var(--white);
            padding: 60px 0 20px;
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-col h3 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-col h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background-color: var(--accent-color);
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            transition: var(--transition);
            opacity: 0.8;
            display: inline-block;
        }

        .footer-links a:hover {
            opacity: 1;
            color: var(--accent-color);
            transform: translateX(5px);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transition: var(--transition);
            color: var(--white);
        }

        .social-links a:hover {
            background-color: var(--accent-color);
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
            opacity: 0.7;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .about-content {
                grid-template-columns: 1fr;
            }

            .about-img {
                order: -1;
                max-width: 600px;
                margin: 0 auto 30px;
            }

            .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {

            .nav-menu,
            .auth-buttons,
            .language-switcher {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero-title {
                font-size: 2.3rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .hero-buttons {
                flex-direction: column;
                gap: 12px;
            }

            .hero-buttons .btn {
                width: 100%;
                max-width: 250px;
                margin: 0 auto;
            }
        }

        @media (max-width: 576px) {
            .section {
                padding: 60px 0;
            }

            .service-card,
            .announcement-card {
                max-width: 350px;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <img src="https://via.placeholder.com/50x50" alt="Ifaa Bulaa Kebele Logo">
                <span class="logo-text">Ifaa Bulaa Kebele</span>
            </div>

            <div class="nav-container">
                <nav class="nav-menu">
                    <ul>
                        <li class="nav-item"><a href="#home" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="#services" class="nav-link">Services</a></li>
                        <li class="nav-item"><a href="#about" class="nav-link">About</a></li>
                        <li class="nav-item"><a href="#announcements" class="nav-link">Announcements</a></li>
                        <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
                    </ul>
                </nav>

                <div class="language-switcher">
                    <div class="language-options">
                        <button class="language-btn active">EN</button>
                        <button class="language-btn">OM</button>
                        <button class="language-btn">AM</button>
                    </div>
                </div>

                <div class="auth-buttons">
                    <button class="auth-btn login"><a href="login.php">Login</a></button>
                    <button class="auth-btn signup">Sign Up</button>
                </div>
            </div>

            <div class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Welcome to Ifaa Bulaa Kebele</h1>
                <p class="hero-subtitle">Serving our community with dedication and excellence</p>
                <div class="hero-buttons">
                    <a href="#services" class="btn">Our Services</a>
                    <a href="#contact" class="btn btn-outline">Contact Us</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section services" id="services">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            <p class="text-center">We provide various services to our community members with efficiency and care.</p>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-img">
                        <img src="https://images.unsplash.com/photo-1581093196276-3e5b3f8a8b0a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Land Registration">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Land Registration</h3>
                        <p>We assist with all land registration processes and documentation.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-img">
                        <img src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Business License">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Business License</h3>
                        <p>Get your business registered and licensed through our office.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-img">
                        <img src="https://images.unsplash.com/photo-1576086213369-97a306d36557?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Social Services">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Social Services</h3>
                        <p>Access to various social support programs and assistance.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-img">
                        <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Marriage Registration">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Marriage Registration</h3>
                        <p>Official registration of marriages and related services.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-img">
                        <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Birth Certificate">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Birth Certificate</h3>
                        <p>Register births and obtain official birth certificates.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-img">
                        <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Community Support">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Community Support</h3>
                        <p>Various programs to support community development.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section about" id="about">
        <div class="container">
            <h2 class="section-title">About Us</h2>

            <div class="about-content">
                <div class="about-text">
                    <h3>Our Kebele at a Glance</h3>
                    <p>Ifaa Bulaa Kebele is a local administrative unit serving the community with various governmental and social services. We are committed to providing efficient and transparent services to all residents.</p>
                    <p>Our office handles land administration, business registration, social services, and other community needs. We work closely with local authorities to ensure the well-being of our residents.</p>
                    <p>With a team of dedicated professionals, we strive to make our services accessible to everyone in the community, regardless of background or status.</p>
                    <a href="#contact" class="btn" style="margin-top: 20px;">Learn More</a>
                </div>
                <div class="about-img">
                    <img src="https://images.unsplash.com/photo-1566438480900-0609be27a4be?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Ifaa Bulaa Kebele Office">
                </div>
            </div>
        </div>
    </section>

    <!-- Announcements Section -->
    <section class="section announcements" id="announcements">
        <div class="container">
            <h2 class="section-title">Announcements</h2>
            <p class="text-center">Stay updated with our latest news and important notices.</p>

            <div class="announcements-grid">
                <div class="announcement-card">
                    <div class="announcement-date">October 15, 2023</div>
                    <div class="announcement-content">
                        <h3 class="announcement-title">Community Meeting</h3>
                        <p>There will be a community meeting on October 20th to discuss upcoming development projects.</p>
                    </div>
                </div>

                <div class="announcement-card">
                    <div class="announcement-date">November 3, 2023</div>
                    <div class="announcement-content">
                        <h3 class="announcement-title">New Service Hours</h3>
                        <p>Starting November 10th, our office will be open from 8:30 AM to 4:30 PM, Monday to Friday.</p>
                    </div>
                </div>

                <div class="announcement-card">
                    <div class="announcement-date">December 1, 2023</div>
                    <div class="announcement-content">
                        <h3 class="announcement-title">Holiday Schedule</h3>
                        <p>Our office will be closed from December 25th to January 1st for the holiday season.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section contact" id="contact">
        <div class="container">
            <h2 class="section-title">Contact Us</h2>
            <p class="text-center">Reach out to us for any inquiries or assistance you may need.</p>

            <div class="contact-container">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Address</h3>
                            <p>Ifaa Bulaa Kebele, Oromia Region, Ethiopia</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Phone</h3>
                            <p>+251 123 456 789</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Email</h3>
                            <p>info@ifaabulakebele.gov.et</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Working Hours</h3>
                            <p>Monday - Friday: 8:30 AM - 5:30 PM</p>
                            <p>Saturday: 9:00 AM - 1:00 PM</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form">
                    <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" required></textarea>
                        </div>
                        <button type="submit" class="btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-col">
                    <h3>About Ifaa Bulaa</h3>
                    <p>Ifaa Bulaa Kebele is committed to serving our community with transparency, efficiency, and dedication.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-telegram"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#announcements">Announcements</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3>Our Services</h3>
                    <ul class="footer-links">
                        <li><a href="#">Land Registration</a></li>
                        <li><a href="#">Business License</a></li>
                        <li><a href="#">Social Services</a></li>
                        <li><a href="#">Marriage Registration</a></li>
                        <li><a href="#">Birth Certificate</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3>Newsletter</h3>
                    <p>Subscribe to our newsletter to get updates on our services and announcements.</p>
                    <form>
                        <input type="email" placeholder="Your Email" required>
                        <button type="submit" class="btn" style="width: 100%; margin-top: 10px;">Subscribe</button>
                    </form>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2023 Ifaa Bulaa Kebele. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>