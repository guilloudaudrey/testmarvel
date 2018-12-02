test Marvel
===========

A Symfony 3.4 project created on November 27, 2018, 2:58 pm.


## Overview

This application allows users to access to a list of 20 characters in the main page, and then navigate into each character's page to see the details of this character. 
Data for this app is from ```Marvel API```.

## Installation


1. Clone or download repository

    https://github.com/guilloudaudrey/testmarvel.git

2. Run composer
```
composer install
```
3. Run server and go to http://localhost:8000/ 
```
php bin/console server:start
```
## Setup Local Environment Variables

Create a developer account in the Marvel API web page, where you will get your '''PRIVATE_KEY''' and '''PUBLIC_KEY". Create a file with the name of '.env' in app/config. And list the following local environment variables:
```
PRIVATE_KEY=YOUR PRIVATE KEY
PUBLIC_KEY=YOUR PUBLIC KEY

```  
    
## Tests    
Execute this command to run tests:

```bash
./vendor/bin/simple-phpunit 
```
