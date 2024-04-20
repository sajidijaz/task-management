# Task Management Application

This Task Management Application is a simple yet powerful tool developed using Laravel Sail, which provides a Docker-based environment for easy development and deployment. The application allows users to manage tasks with functionalities such as creating, editing, deleting, and reordering tasks. It also supports project-based task management, allowing tasks to be categorized under projects.

### Features

- **Task Management:** Create, edit, and delete tasks with ease.
- **Project Management:** Organize tasks under specific projects.
- **Priority Setting:** Assign priorities to tasks, and reorder them interactively.

## Installation

### Clone the Repository

To get started, clone the repository to your local machine:

```bash
git clone https://github.com/sajidijaz/task-management.git
cd task-management
```

We are using the [laravel sail](https://laravel.com/docs/11.x/sail) to install laravel project and other dependencies.
You may install the application's dependencies by navigating to the application's directory and executing the following command. This command uses a small Docker container containing PHP and Composer to install the application's dependencies:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

## Set Up Laravel Sail
Laravel Sail provides a simple command-line interface for managing Docker containers. Begin by setting up your environment:
```bash
cp .env.example .env
```
Adjust the .env file to match your local development environment settings, especially the database configurations.
```bash
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=password
```

Launch the Docker environment using Sail:

```bash
./vendor/bin/sail up -d
```

## Generate Application Key
Generate a new application encryption key:
```bash
./vendor/bin/sail artisan key:generate
```

## Clear Cache
```bash
./vendor/bin/sail artisan cache:clear
```

## Database Setup
Run the database migrations to create the necessary tables:
```bash
./vendor/bin/sail artisan migrate
```

## Install Node.js Dependencies (Optional)
If you're using Laravel Mix to manage assets:
```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

### Add the alias for easy execution _(no need to write full command every time)_
```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

## Serving Your Application

Finally, you may start Sail. To serve your project locally using Sail:

```bash
./vendor/bin/sail up
```

Once the Bash alias has been configured, you may execute Sail commands by simply typing sail. The remainder of this documentation's examples will assume that you have configured this alias:

```bash
sail up
```

## Starting & Stopping Sail

Laravel Sail's docker-compose.yml file defines a variety of Docker containers that work together to help you build Laravel applications. Each of these containers is an entry within the services configuration of your docker-compose.yml file.

Before starting Sail, you should ensure that no other web servers or databases are running on your local computer. To start all of the Docker containers defined in your application's docker-compose.yml file, you should execute the up command:

```bash
sail up
```

To start all of the Docker containers in the background, you may start Sail in "detached" mode:

```bash
sail up -d
```

To stop all the containers, you may simply press Control + C to stop the container's execution. Or, if the containers are running in the background, you may use the stop command:

```bash
sail stop
```

## Usage

Once the installation is complete, you can access the application by navigating to:

```bash
http://localhost
```
From here, you can start creating, managing, and organizing tasks within projects.
