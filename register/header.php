<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> NIT College</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel = "stylesheet" href = "style.css">
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            line-height: 1.6;
            color: #333;
        }
        
        /* Header styles */
        header {
            background: #003366;
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
        }
        
        .logo {
            height: 60px;
            margin-right: 15px;
        }
        
        .college-name h1 {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }
        
        .college-name p {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 20px;
        }
        
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s;
        }
        
        nav ul li a:hover {
            opacity: 0.8;
        }
        
        .apply-btn {
            background: #ff6600;
            padding: 8px 15px;
            border-radius: 4px;
        }
        
        /* Mobile menu styles */
        .mobile-menu-btn {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                align-items: flex-start;
            }
            
            nav ul {
                display: none;
                flex-direction: column;
                width: 100%;
                margin-top: 1rem;
            }
            
            nav ul.show {
                display: flex;
            }
            
            nav ul li {
                margin: 5px 0;
            }
            
            .mobile-menu-btn {
                display: block;
                position: absolute;
                top: 20px;
                right: 20px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo-container">
                <img src="../images/logo.png"class="logo">
                <div class="college-name">
                    <h1>Northwell Institute of Technology</h1>
                    <p>Excellence in Education Since 2020</p>
                </div>
            </div>
            
            <nav>
                <ul id="main-nav">
                    <!-- <li><a href="index.html">Home</a></li> -->
                    <li><a href="#about">About</a></li>
                    <li><a href="#academics">Academics</a></li>
                    <li><a href="#registration">Registration</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="#registration" class="apply-btn">Apply Now</a></li>
                </ul>
            </nav>
            
            <div class="mobile-menu-btn" id="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>
    
    <main>
        <!-- Content will be loaded here -->
        <div id="content-container"></div>
    </main>