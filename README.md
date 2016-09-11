# Quiz-Analyzer
A Web application to automate the task of quiz correction

Based on the PHP Laravel (5.2) framework.

Requirement:

- PHP >= 5.5.9

- Apache server

- MYSQL server

Instructions how to set the server:

1. Clone or Download the repository ( Master Branch )

2. Composer is required so download it from its official [website](https://getcomposer.org/) according your system

3. Navigate to the project directory ~/Quiz-Analyzer/

4. Use `composer install` to install Larvel and its dependencies   

5. Copy .env.example to .env

6. Edit according to the your machine configuration
        `DB_CONNECTION=mysql
         DB_HOST=127.0.0.1
         DB_PORT=3306
         DB_DATABASE=homestead
         DB_USERNAME=homestead
         DB_PASSWORD=secret`  


7. Use `php artisan key:generate` to generate the security key

8. Use `php artisan migrate` to setup database

9. Use `php artisan serve`  to run the server in development mode.
  - for the production make the apache server point to ~/Quiz-Analyzer/public  

Instruction to run the application:

1. After the server is running. use <host>/admin/login to login as Admin ( first time you have to register ) and set the question set i.e. question paper id and correct answers which will be used for the evaluation of the response submitted by participants.

2. Use generate scorecard to generate to the final score card once each participants have submitted there response.

There is a lot much, Why don't you explore it?
