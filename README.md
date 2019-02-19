
# Sample Symfony Test app

A Travel Blog where users can register and post their stories.

# Concepts
 - Using Annotations for routing
 - Using Doctrine for database 
 - Using formBuilders for forms
 - Using Twig Template Engine for loading the views

# Requirements
 - PHP 7.1.3 or higher;
 - PDO-SQLite PHP extension enabled;
 - and the usual [Symfony application requirements]

# Run the app
  - clone the project from git by typing `git clone`
  - Run this `composer install`

# Database Configuration
  - To create the database `php bin/console doctrine:database:create`
  - Migrate the entities into database `php bin/console doctrine:migrations:migrate`