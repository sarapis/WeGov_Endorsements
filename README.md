Installation Instructions
Run git clone https://github.com/sarapis/data_mygov_nyc_v2
Create a MySQL database for the project
mysql -u root -p, if using Vagrant: mysql -u homestead -psecret
create database mygov;
\q
From the projects root run cp .env.example .env
Configure your .env file
Run composer update from the projects root folder
From the projects root folder run sudo chmod -R 755 ../data_mygov_nyc_v2
From the projects root folder run php artisan key:generate
From the projects root folder run composer dump-autoload
After login in admin panel, try synchronize of Data from Airtable.
