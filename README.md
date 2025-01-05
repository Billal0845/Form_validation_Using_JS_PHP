1. make a database named: project_db
2.create user table:
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

3. Register an user and login


what you need:

set smtp mailer with  your email
create necessary tables in phpMyAdmin panel

Features: 
1. username validation
2. password validation : Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.
3. Password recovery system using OTP through email
4. New user Registration
5. User Admin Role ; set a user role as admin hardcoded.
6. If user successfully  logged in, redirecting into a new page.

complete explanation: https://www.youtube.com/watch?v=K9RujAuwmvg&t=204s
