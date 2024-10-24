ArtHub

ArtHub is a web-based platform for art enthusiasts and artists to connect, explore, and share artwork. Artists can create profiles, upload their work, and receive reviews, while users can browse artworks, leave ratings and comments, and communicate directly with artists.

Features

    User authentication (login, registration)
    Profile management (view/create profile)
    Upload artwork
    Browse artworks
    Leave reviews and ratings on artworks
    Direct messaging between users and artists
    Artwork categorization and filters

Technologies Used

    Frontend: HTML, CSS, JavaScript
    Backend: PHP
    Database: MySQL
    Server: XAMPP (Apache, MySQL)

Installation and Setup
Prerequisites

Before you begin, ensure you have met the following requirements:

    Download and Install XAMPP (includes PHP, MySQL, Apache).
    A web browser (Google Chrome, Firefox, etc.).

Step-by-Step Installation Guide

  Clone the repository: Download the project files or clone the repository to your local machine:


    git clone https://github.com/ahmedmuteeba/ArtHub

Move the project to XAMPP directory:

    After downloading or cloning, move the entire project folder to the htdocs directory inside your XAMPP installation. Typically:

        C:/xampp/htdocs/

    Rename the project folder to arthub if not already named.

Start XAMPP:

    Open XAMPP Control Panel.
    Start Apache and MySQL services.

Create the Database:

    Open your browser and navigate to phpMyAdmin.
    Create a new database named project.
    Import the database file project.sql located in the project root directory:
        In phpMyAdmin, select the project database, go to the Import tab, and choose the project.sql file.
        Click Go to import the tables and data.

Configure Database Connection:

  Open the db.php file located in the project directory and ensure the following settings match your XAMPP installation:

    $host = 'localhost';
    $db = 'project';
    $user = 'root';  // default XAMPP user
    $pass = '';      // leave blank for XAMPP

Access the Application:

    Open your browser and navigate to the project URL:

        http://localhost/arthub/homepage.php

    This will take you to the homepage of the ArtHub platform.

Database Setup
Database Name: project

The following tables are used in the application:

    users: Stores user information including full name, username, email, and password.
    profile: Stores additional profile information like bio, profile picture, social links, and business name.
    artwork: Stores artwork details like name, description, category, price, dimensions, and images.
    reviews: Stores user reviews, ratings, and comments on artworks.
    messages: Stores direct messages between users and artists.
    categories: Stores artwork categories for easier browsing.
    conversations: Stores conversation data between users.

The database structure can be seen in the provided project.sql file and imported via phpMyAdmin.

Dependencies

The project uses the following tools and technologies:

    XAMPP (Apache, MySQL, PHP)
        Download XAMPP

    PHP (Server-side scripting language)
        PHP is included with XAMPP.

    MySQL (Database)
        MySQL is also included in XAMPP. The database used is project, and the structure is imported from project.sql.

    HTML, CSS, JavaScript
        No external libraries or frameworks have been used. You can modify the styles and scripts inside the css and js folders respectively.
