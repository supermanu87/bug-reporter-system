# Bug Reporter System

## Application description

The purpose of this web application is to store and retrieve bug list of all software developments. 

## Architecture overview

This web application is based on Codeigniter Framework (v. 4.4.3), PHP 7.4 and Mysql v8
This application could be started in development mode in a local environment with Docker and the production environment is hosted on Google Cloud APP Engine.
A CI/CD pipeline is configured with Google Cloud Build in order to continously integrate and deploy new commits.

## Setup

Prerequisites:
 - Linux or Windows OS
 - Docker Engine
 - Docker compose

In local environment launch the following command:

  docker-compose up

If no errors occurs this is the list of containers:

bug-reporter-system-web
phpmyadmin/phpmyadmin
mysql:5.7

The web application could be reached on http://localhost

![immagine](https://github.com/supermanu87/bug-reporter-system/assets/15850349/96a45097-0673-4d32-ab29-5a7c3d1127e5)

Docker compose provide also phpmyadmin client in order to manage the database, visit localhost:8088

localhost:8088

![immagine](https://github.com/supermanu87/bug-reporter-system/assets/15850349/68b32267-1347-492d-9b37-0996097fd221)


When a push event occurs a CI/CD pipeline hosted on Google Cloud Build will automatically deploy the web application on Google Cloud App Engine.
This is the production endpoint:

https://bug-reporter-management.ew.r.appspot.com/

## User Stories

User Story #1

As an Operator of "Bug-Reporter-System"
I would to retrieve the list of all the bugs registered
So I can evaluate how many bugs were tracked during software development

User Story #2

As an Operator of "Bug-Reporter-System"
I would to retrieve a subset of bug list based on fulltext query search
So I can evaluate how many specific bugs were tracked during software development

User Story #3

As an Operator of "Bug-Reporter-System"
I would to register a new software bug
So I can track all the bugs during software development




