
# DDD and Hexagonal Architecture Application

[![Build Status](https://secure.travis-ci.org/pgrau/ddd.svg?branch=master)](http://travis-ci.org/pgrau/ddd)
    
    Training some best practices of modern PHP development
    
    By default this app uses:
    
    Fast route
    Service Container
    Doctrine 2
    Plates
    Symfony command line
    
    You can create new users with the follow command:
    (before execute this command follow the instructions of the docs)
            
    php console user:create        

## Install components 
    curl -sS https://getcomposer.org/installer | php
    php composer.phar install    

## Vagrant
    Debian 8 Vagrant image
    which is preconfigured for testing PHP apps and developing extensions across many versions of PHP.
    You can see all documentation in doc/vagrant or https://github.com/rlerdorf/php7dev
    
## Set up the project with Vagrant
    Edit your /etc/hosts file  
    192.168.7.8 training.dev
    
    vagrant up
    vagrant ssh
    
    Edit nginx config. file
    sudo vim /etc/nginx/conf.d/default.conf
    and change root:
    root   /var/www/default/public;

    sudo service nginx reload 
    
    You can run now  the app in your browser: http://training.dev

## MySQL

    Vagrant contain a MySQL
    Execute the follow command:

    ssh -C -N -f -L3306:127.0.0.1:3306 vagrant@192.168.7.8
    
    And execute the SQL needed to update the database schema:
    
    php bin/doctrine orm:schema-tool:update --force
    
## Coding Style Guide
   [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)

## Routes
    FastRoute link - Fast request router for PHP https://github.com/nikic/FastRoute
    
## Service Container (Dependency Injection)
    Small but powerful dependency injection container http://container.thephpleague.com

## ORM    
    Doctrine 2 is an object-relational mapper (ORM) for PHP 5.4+
    Mapping files are available in:
    src/Training/Infrastructure/Persistence/Doctrine/mapping
    
## Templates    
    Native PHP template system http://platesphp.com
    All templates are in: src/Training/Infrastructure/UI/View/Plates

## Controllers
    All controllers are in: src/Training/Infrastructure/UI/Controller
    
## Command-line commands
    Symfony Console Component
    The Console component eases the creation of beautiful and testable command line interfaces.    
    
    You can run the command lines with the follow command: php console
    
## Unit Tests
    Unit Tests are available. 
    You can run the tests with the follow command: php bin/phpunit
