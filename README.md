# PlayerProviderMicroservice

work in progress!

sample microservice project version of myScoreboardAdmin based on symfony 5 

Installation
============
## clone project
clone project into your apache2 document root directory
```
git clone https://github.com/snoke/PlayerProviderMicroservice.git PlayerProvider
```
## install vendors
then install vendors by
```
cd PlayerProviderMicroservice
composer update
```
## DB Setup
create a new (utf8mb4) database named "PlayerProvider"
and configure parameter DATABASE_URL in .ENV to your mysql host

### Migrations
now you can run migrations to create Database Tables and entries by
```
php bin/console do:mi:mi
```
Usage
============

http call on /api will output a complete 
list about all members with with full details as json

you can easily add filter paramters as query:
```
/api?name=John Doe
```
or even more complex:
```
/api?name=John Doe&team.league.name=Erste Bundesliga
```


