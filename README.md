# DDD and Hexagonal Architecture Application
Training best practices of modern PHP development

## Vagrant
    Debian 8 Vagrant image which is preconfigured for testing PHP apps and developing extensions across many versions of PHP.
    See:https://github.com/rlerdorf/php7dev
    
## Set up the project with Vagrant
    Edit your /etc/hosts file  
    192.168.7.8 training.dev

    curl -sS https://getcomposer.org/installer | php
    php composer.phar install
    
    vagrant up
    vagrant ssh
    
    Edit nginx config. file
    sudo vim /etc/nginx/conf.d/default.conf
    and change root:
    root   /var/www/default/public;

    sudo service nginx reload 
    
    You can run now  the app in your browser: http://training.dev
    
## Route
    We use FastRoute - Fast request router for PHP https://github.com/nikic/FastRoute
    
## Service Container (Dependency Injection)
    We use Small but powerful dependency injection container http://container.thephpleague.com
    
## Template    
    We use Native PHP template system http://platesphp.com
