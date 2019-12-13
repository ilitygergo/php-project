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

#### Containers

If you are using Windows, you have to install Docker Desktop and share the drive you pulled the project into.

First, you have to install docker and docker-compose on your system and run `docker-compose build` 
from the bench-project directory. After that, run `docker-compose up -d` to run the containers.
You can stop them with `docker-compose stop`

#### Database

Connect to the docker database with a program of your choice (I chose sql developer). The credentials 
can be found in the _env.example.php_ file. When you have a connection run the _uml/tables.sql_ SQL 
commands in the database to initialize the data.

---

Now you can access your local environment in `http://localhost:8080/`
