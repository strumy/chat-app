# chat-app
This is the code base for a simple Laravel chat application.

Chat App is a simple Laravel (v.13) application with packages, breeze, reverb, echo and pusher to enable loggedin users to exchange messages 1-to-1 in real time.

## Features
- User Login
- Listing all users for chat
- Chat with other users 1 to 1.

## Installation

### Pre-requisites:
  --PHP >= PHP 8
  --Composer
  --PostgreSQL

### Clone the repository, or download the zip file and extract it.

```
git clone https://github.com/strumy/chat-app.git && cd chat-app
```

+ Copy the .env.example file to .env: ```cp .env.example .env```
+ Install the dependencies. ```composer install```
+ Generate the application key. ```php artisan key:generate```
+ Refresh the application cache. ```php artisan optimize```
+ Run the migrations and seed the database. ```php artisan migrate```

+ Start the Reverb server: ```php artisan reverb:start --host=0.0.0.0 --port=8080```
+ Start the development server of node.js: ```npm run dev```
+ Start the queue processing: ```php artisan queue:work```
+ Start the development server using the command below:
```php artisan serve --host=0.0.0.0 --port=8000```
+ Open the application in a browser at http://localhost:8000.

## License

The CHat App is using license under the [MIT license](https://opensource.org/licenses/MIT).