Steps to run the test application  

( it is written to fit the basic needs of a dev environment, meaning I used the artisan built-in server )

All we need is a MySQL database server running on port 3306, and I have set the localhost DB username to root
and password to an empty string. Modify anything you might need to, in the .env file 

1) Clone the public repo from the given github url
2) Run migrations with php artisan migrate
3) Run database seeder with php artisan db:seed
4) Run the websocket server with php artisan websocket:serve ( a custom command of mine )
5) Run php artisan serve
6) Browse to http://localhost:8000


keep the main page open and try to update or create products in separate tabs. 
Then come back to the main page, without reloading it and watch it being updated dynamically.
