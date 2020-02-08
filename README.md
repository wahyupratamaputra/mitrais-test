
# ------------- Backend -------------

  

Here i'am using Laravel framework, and inside of that using composer package..
if you don't have composer, please visit [https://getcomposer.org/download/](https://getcomposer.org/download/)

##### Make sure you are in 'Backend' folder to execute command below
## Project setup

```
composer install
```

### Setup the database
Make sure you already create mysql database named 'mitrais_test' or create one with that name then run command below
```
php artisan migrate
```
 
### Run the backend local development
```
php artisan serve
```
##### Make sure backend running by showing default Welcome page here [http://localhost:8000/](http://localhost:8000/)


#

# -------------- Frontend -------------

  
##### Make sure you are in 'Frontend' folder to execute command below
## Project setup

```
npm install
```

 
### Compiles and hot-reloads for development
```
npm run serve
```
##### Then access via browser [http://localhost:8080/](http://localhost:8080/)