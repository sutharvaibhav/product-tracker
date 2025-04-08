## product-tracker
 Laravel 10-based web application that allows users to:

    - Submit product details (name, quantity, and price)
    - Save data in a JSON file
    - Display all submitted products with timestamps
    - Automatically calculate total value (quantity × price)
    - Edit submitted product entries
    - Display grand total of all products
    - Uses Bootstrap and AJAX for a seamless frontend experience

## Database Configuration

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=product-tracker
DB_USERNAME=root
DB_PASSWORD=

*run command in terminal* : php artisan migrate
and select to create database if not exist

## Setup Instructions

1. **Clone the repository**
   git clone https://github.com/sutharvaibhav/product-tracker.git
