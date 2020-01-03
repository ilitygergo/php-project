# Bench-project

My task is to build an online retail shop by following these bulletpoints:
* PHP OOP
* docke-compose.yml to run the project
* MySQL (I used MariaDB)
* PhpUnit
* .env configuration
* SOLID principles
* Sass
* File handling

# Setup

#### Packages

For using the correct package versions, you have to install composer and npm, than run the following commands:
- `npm install`
- `composer install`

#### Containers

If you are using Windows, you have to install Docker Desktop and share the drive you pulled the project into.

First, you have to install docker and docker-compose on your system and run `docker-compose --build` 
from the bench-project directory. After that, run `docker-compose up -d` to run the containers.
You can stop them with `docker-compose stop`

#### Database

Connect to the docker database with a program of your choice (I chose sql developer). The credentials 
can be found in the _env.example.php_ file.

---

Now you can access your local environment in `http://localhost:8080/`
