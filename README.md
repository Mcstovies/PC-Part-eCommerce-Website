## MKPC - PC Parts eCommerce Website

Created during CodeSpace Bootcamp

MKPC is a full-stack eCommerce website designed to sell PC components like CPUs, Graphics Cards, and Memory Cards. This project demonstrates a complete eCommerce solution, from user authentication to CRUD operations, with a responsive frontend and a structured backend.

## Project Overview

This project was built as part of my CodeSpace bootcamp to gain hands-on experience in full-stack web development. MKPC features user registration, login, and session-based shopping cart functionality, allowing users to browse products by category, add items to their cart, and view the cart contents.
## Features

    User Authentication: Secure user registration and login with hashed password storage.
    Product Categories: Allows users to filter products by category (CPUs, Graphics Cards, Memory Cards).
    Shopping Cart: Session-based cart functionality, enabling users to add products, adjust quantities, and view the cart.
    CRUD Operations: Full CRUD system for product management, enabling admins to create, read, update, and delete items.
    Consistent Styling: Custom dark and red theme applied across all pages for visual consistency.

## Technologies Used

    PHP: Server-side scripting for dynamic content generation, session management, and form handling.
    MySQL: Database for user information, product catalog, and orders, with relational tables and foreign key constraints.
    HTML5 & CSS3: Structuring content and applying custom styles for a clean, accessible layout.
    Bootstrap: Framework for responsive, mobile-first design, enhancing the site's usability across devices.
    JavaScript: Added interactivity and validation to improve user experience.
    Cypress: Automated testing for key features, ensuring reliability in login, cart, and product browsing functions.

## Getting Started
Prerequisites

    Web Server: Apache or Nginx
    Database: MySQL
    PHP Version: PHP 7.x or later

## Installation

    Clone the Repository:

    git clone https://github.com/your-username/mkpc-ecommerce.git

    Setup Database:
        Import the database.sql file included in the repo to set up the required tables.

    Update Database Configuration:
        Update the database connection details in connect_db.php.

    Start the Server:
        Run the website on a local server (XAMPP, WAMP, etc.) or configure it on your web server.

## Usage

    Register/Login: Users can create an account, log in, and log out.
    Browse Products: Products are organized into categories and can be viewed individually.
    Shopping Cart: Add items to the cart, adjust quantities, and proceed to view the cart.

## Lessons Learned

    Backend Development: Gained experience in using PHP for secure session management and database interaction.
    Frontend Styling: Enhanced site design with Bootstrap and CSS, implementing a consistent, branded look.
    Database Design: Designed and implemented a normalized MySQL database, including foreign key constraints.
    Testing: Developed Cypress tests for critical user flows, learning the value of automated testing in maintaining project quality.

Acknowledgments

This project was completed as part of the CodeSpace bootcamp, where I learned and applied the fundamentals of full-stack development. Thanks to the instructors and mentors at CodeSpace for their guidance and support!
