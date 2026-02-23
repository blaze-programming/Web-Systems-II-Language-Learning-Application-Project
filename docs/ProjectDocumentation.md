## Project Goals and Objectives
The primary goal is to develop a mobile-first client-server web application that serves as a low-barrier entry point for Japanese language learners. Key objectives include:

-	Facilitate "Kana" Mastery: Provide interactive exercises for Hiragana and Katakana.
- Build Foundation: Provide listening and grammar exercises to ground users in the basics of the language.
- Prepare for Future Learning: Prepare users with the necessary fundamentals to transition into in-depth learning methods like immersion.

## Stack Elements (LAMPS) 
1. Linux (Operating System Layer)

Runs Apache, MySQL, and PHP

Provides a stable environment for audio files, images, and lesson content

Supports file uploads and media handling for language lessons

2. Apache (Web Server Layer)

Apache handles all HTTP requests and delivers pages to users.

Role in the application:

Delivers the web and mobile-responsive interface

Processes requests to controllers through index.php

Enables URL routing using .htaccess

3. MySQL (Database Layer)

MySQL stores all application data and is managed through Bluehost’s MySQL tools and phpMyAdmin.

Data stored includes:

User accounts

Lesson content (Hiragana, Katakana, Kanji, vocabulary)

Quiz questions and multiple-choice answers

Flashcard decks

User progress (scores, completed lessons, streaks)

Key Features for This Project:

Relational tables allow connecting lessons → quizzes → progress

Uses PDO in PHP for secure database access

4. PHP (Server-Side Language Layer)

PHP acts as the core logic engine behind the application.

Used for:

Loading lessons dynamically

Serving quiz questions

Generating flashcards

Handling login and registration

Saving and retrieving user progress

Sending JSON data to the mobile-style front end

Connectors to other STACK elements:

Uses PDO to connect to MySQL

Runs within Apache

5. Front-End Technologies (Client Layer)

HTML5

Creates the structure for lesson pages, flashcards, and quiz screens.

CSS3 / Bootstrap

Handles responsive layout so the app works on mobile devices (BlueOcean supports mobile-friendly previews).

JavaScript / jQuery

Used for:

Flashcard flipping animations

Interactive quizzes

Audio playback for pronunciation

Updating progress without page reloads (AJAX)

6. Data Storage & Media Files

The application includes custom media for Japanese study.

Stored in /assets/audio and /assets/images, including:

Audio pronunciations

Lesson illustrations

Icons for UI elements

## Language and Coding 




## Interface design speficiations 
The following image depicts the desired appearance

<img width="393" height="665" alt="kana exercises vertical slice" src="https://github.com/user-attachments/assets/92979e61-3103-4298-a121-b23a5788e7e5" />

## User Navigation
The application follows a structure to guide users to specific learning exercises

### User Flow Diagram
<img width="1994" height="990" alt="Screenshot 2026-02-19 030827" src="https://github.com/user-attachments/assets/bc4a3b08-2570-44b8-b734-021cbf7242ed" />

## User Interface Specifications by Screen
Each page has its own user interface requirements

Examples of what the user interface should be like for each page:

### Home
Where users can find the applications goals and begin their journey

<img width="393" height="665" alt="home" src="https://github.com/user-attachments/assets/ea60c0cc-0b38-462f-968a-e7df53963df8" />

### Profile
Where users can see and edit their profile information, learning progress, and exercise settings

<img width="393" height="665" alt="profile" src="https://github.com/user-attachments/assets/7848baad-39b3-49e2-a5d5-8c67e5002442" />

### Login
Where the user can login to their account to save their progress

<img width="393" height="665" alt="login" src="https://github.com/user-attachments/assets/a34260c7-63fa-42e3-b6c4-8a8aee834999" />

### Select Exercise
Where users will select which exercises they wish to practice

<img width="393" height="665" alt="select exercise" src="https://github.com/user-attachments/assets/27d167f8-6b1c-4d22-9002-189a41d3f6a8" />

### Select Kana Level
Where users can easily select the correct level of exercises to receive

<img width="393" height="665" alt="select kana level" src="https://github.com/user-attachments/assets/d72c0349-6d10-4815-8189-d9f13ef493da" />

### Determine Kana Knowledge
Where users can more acturately specify which kana they have learned

<img width="393" height="665" alt="determine kana knowledge" src="https://github.com/user-attachments/assets/e2c2f832-bfc0-436a-aa3f-e8fceae14b49" />

### Explain Kana
Where users can learn the basics of what kana are before startign exercises

<img width="393" height="665" alt="explain kana" src="https://github.com/user-attachments/assets/8337b3c0-870a-429c-988e-ad760b7d142e" />

### Kana Learning Home
Where users can see their kana learning progress and begin kana exercises

<img width="393" height="665" alt="kana learning home" src="https://github.com/user-attachments/assets/971c7dd1-95c3-4659-8aa4-c6854372ef67" />

### Kana Exercises
where users can train their kana mastery through exercises

<img width="393" height="665" alt="kana exercises" src="https://github.com/user-attachments/assets/e400faed-5262-4261-ba45-59eacf90afb8" />

### Select Listening Level
Where users can easily select the correct level of listenting exercises to receive

<img width="393" height="665" alt="select listening level" src="https://github.com/user-attachments/assets/bda87bb0-cf1b-4ebf-b434-9f5e84774232" />

### Explain Listening Exercises
Where users can find the philosophy behind listening exercises

<img width="393" height="665" alt="explain listening exercises" src="https://github.com/user-attachments/assets/9adfbc5b-2b65-4347-8bbb-9240247133fd" />

### Listening Home
Where users can see their listing progress and begin listiening exercises

<img width="393" height="665" alt="listening home" src="https://github.com/user-attachments/assets/770ef3a7-6281-4651-987e-0ce6d5910256" />

### Listening Exercises
Where users can train their listening ability through exercies

<img width="393" height="665" alt="listening exercises" src="https://github.com/user-attachments/assets/52a8df6d-2886-4eef-b968-96fac159aace" />


## Code modules and object overview

/(http//web-systems-application/)

    index.php

        /config
            database.php
            app_settings.php

        /controllers
            AuthController.php
            LessonsController.php
            QuizController.php
            FlashcardController.php
            ProgressController.php
            DashboardController.php

        /models
            User.php
            Lesson.php
            Quiz.php
            Flashcard.php
            Progress.php

        /views
            /partials
                header.php
                footer.php
                navbar.php

            /auth
                login.php
                register.php

            /dashboard
                index.php

            /lessons
                list.php
                view.php

            /quiz
                start.php
                question.php
                results.php

            /flashcards
                index.php

    /assets
        /css
            style.css
            theme.css

        /js
            main.js
            lessons.js
            quiz.js
            flashcards.js

        /images
            logo.png
            icons/
            lesson_images/

        /audio
            hiragana/
            katakana/
            vocabulary/

    /api
        lessons.php
        flashcards.php
        quiz.php
        progress.php

    .htaccess
    README.md

## Platform and hosting information
Server Environment

-Linux-based shared hosting

-Apache 2.4+ (managed by Bluehost)

-PHP 8.x with common extensions

-MySQL / MariaDB database system

-phpMyAdmin for database administration

-HTTPS / SSL provided automatically

-Deployment Process

All project files are uploaded to the /public_html/ directory using:

-Bluehost File Manager

-No manual installation of Apache/PHP/MySQL is required

-Database Setup

-Databases and users are created through Bluehost → Advanced → MySQL Databases

-SQL schema is imported through phpMyAdmin

-PHP connects to the database using the standard MySQL hostname localhost

Any developer can continue this project by:

-Downloading or cloning the GitHub repository

-Uploading files to (https://github.com/blaze-programming/Web-Systems-II-Language-Learning-Application-Project)

-Creating a MySQL database in cPanel

-Importing schema.sql

-Updating /app/config/database.php with Bluehost credentials

-Running the application through the hosted domain Blue Ocean
