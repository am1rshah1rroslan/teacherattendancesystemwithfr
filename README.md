# Teacher Attendance System with Facial Recognition
This project is a simple web app attendance system that utilizes facial recognition for authentication purpose made for my Final Year Project (FYP) in Universiti Teknikal Malaysia Melaka (UTeM). You are free to use and refer this project for your own personal project. Note that this project may have flaws and security issues, so contribution on improvements are very much welcomed!

How to install:
1) Install XAMPP. (or any localhost server you want to use)
2) Download all the files in this repo and place it into XAMPP 'htdocs' directory.
3) Start XAMPP services. (Apache, MySQL)
4) Import the "tas.sql" file into your DB. (PHPMyAdmin)
5) Enable hardware acceleration for your browser. You may find this in the settings.
6) Make sure to allow webcam access for this system.
7) That is all! You can now access the system by typing the localhost directory of the system. (Example: localhost/attendance/index.php)

Notes on the system:
1) Login credential for ADMIN: username: admin | password: 123456 (Change this in the DB, inside admin table. Password is hashed with SHA256, so please hash your password with SHA256 before changing it).
2) This system does not use any programming framework, as this project aims to help beginner to understand more on web programming and Facial Recognition A.I. Whole system uses native/basic HTML, CSS and JavaScript wth a bit on AJAX and JSON.
3) Facial recognition used in this system is being refered from the following repo (link: https://github.com/WebDevSimplified/Face-Detection-JavaScript). More information on the facial recognition module can be seen here: (link: https://www.youtube.com/watch?v=CVClHLwv-4I&t=317s)
4) All user data used in this system is only a template user consists of famous football (or soccer) players. Please add your own data!
5) Facial recognition module may take some time to load registered user, estimation is about 15 seconds for 20 user.
6) This system is only meant for small organization/groups that consists less than 30 members. More than that will cause facial recognition inaccuracies, performance issue and may crash your computer.
7) In the system, user is assigned with status named TETAP and PINDAH. This status is used to indicate the availability of the user. TETAP means the user is still an employee of the school whereas PINDAH means the user is not an employee anymore. You may change this in the coding if you like.
8) This system is originally written in Bahasa Malaysia due to my FYP stakeholder requirements. So, there maybe some unfamilliar words left out in the system.

That is all! Have fun with this system and good luck on your project!
