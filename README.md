
  




<p align="center">
  <h3 align="center">Laravel 8 School Dashboard</h3>
</p>

<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>

  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project


Laravel 8 School dashboard that includes the following:

* Laravel Authentication
* Migration
* Admin dashboard
* User management
* Class management
* Lessons management
* Grades management
* Permissions
* Roles
* RestApi
* Swagger Api documentation
* http testing


### Built With

* [Bootstrap](https://getbootstrap.com)
* [Laravel](https://laravel.com)
* [Swagger](https://swagger.io/)



<!-- GETTING STARTED -->
### Getting Started

I really (!) recommend to use <a href="https://laradock.io/">Laradock</a>  for fast and easy env preperation.
<a href="https://laradock.io/">Laradock</a> is an easy tool that building you all the env you need to run your project (nginx/apache, mysql,mongodb,php and much much more....) <a href="https://laradock.io/">Laradock</a> using docker compose.

### Prerequisites

-   [Docker](https://www.docker.com/products/docker/)  [ >= 17.12 ]

### Installation


1. Clone the repo
   ```sh
   git clone https://github.com/tobolkin8/BP_laravelApp.git
   ```
2. Please follow the instructions - start with section  A.1 <a href="https://laradock.io/getting-started/">Laradock-getting-started</a>

3. for fast build with laradock
     ```sh
    docker-compose up -d nginx mysql phpmyadmin
   ```
4. for using composer in your project terminal -
   ```sh
    docker-compose exec workspace bash
   ```
  
<!-- USAGE EXAMPLES -->
## Usage
in the workspace terminal run the following commands-
-    **composer install**
-    **php artisan key:generate**
-    **php artisan migrate --seed**
-    **php artisan passport:client --personal** 
-    **php artisan l5-swagger:generate**

This will automatically create all the tables you need in the database.

Testing login info -
Admin -
login: admin@admin.com
password: password

teacher -
login: art@teacher.com
password: password

student -
login: avi@student.com
password: password


<!-- URls -->
## URls
- swagger Api documentation - http://localhost/Api/documentation
- http testing - http://localhost/api-tester 

ENJOY!



<!-- CONTACT -->
## Contact

Nina Tobolkin -  sokolov8nina@gmail.com



