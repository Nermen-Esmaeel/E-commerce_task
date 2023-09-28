

## Ecommerce API

This is a simple Laravel-based API for Small Ecommerce website the application allows users to register, log in, create and manage categories , Product , apply role-based access control, and perform various other tasks related to cart.

## How To Install ?
- **git clone https://github.com/Nermen-Esmaeel/E-commerce_task.git**
- **cd E-commerce_task**
- **composer install**
- **cp .env.example .env**
- **php artisan key:generate**
- and then write the db name in the env file, run the xampp and run those commands:
- **php artisan migrate:fresh --seed**
- **php artisan jwt:secret**
- **php artisan serve**
  
## Api Documentation

For detailed information about available endpoints and their usage, please refer to the API documentation.[documentation](https://documenter.getpostman.com/view/28278330/2s9YJZ3jag) 


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
