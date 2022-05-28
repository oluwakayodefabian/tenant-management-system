# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter
CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](http://codeigniter.com).

# STEPS TO SETUP YOUR APP 🙂

- The url to open the application on the browser is
  `http://localhost/tenant-management-system/public/`

CREATE A DATABASE NAMED `tenant_mgt_system`

## To create all the tables needed

open your terminal and run `php spark migrate`
![terminal command to add the tables created so far to your database](repo_images%5Cterminal%20cmd.PNG)

### Open phpAdmin in any browser of your choice, navigate to the **tenant_mgt_system** database, then click on the admin_users table and then click on the sql tab copy the sql code below, to insert data for the into the admin_users table

INSERT INTO `admin_users` (`admin_id`, `first_name`, `last_name`, `admin_email`, `admin_username`, `admin_type`, `password`, `unique_id`, `created_on`) VALUES
(1, 'Abdulkadri ', 'Zinat', 'oluwakayodefabian@gmail.com', 'admin', 'super_admin', '$2y$10$h5gdAgLmQdtVVrC20Db0DOVhL1/C8EOKe3LgDU8ifdo7xALFzZmCC', '628f68e2da931PHdnBeq3FT1chgCE', '2022-05-26 12:40:30'),
(2, 'Oluwakayode', 'Fabian', 'oluwakayodefabian4@gmail.com', 'oluwakayode', 'sub_admin', '$2y$10$MHL6BBLOmZ8c5So5WtVSIebgUkwcNgy4Hqp/5RXuq0PGRBXfxXcV2', '628fb1ef01cbf8927572315f24506f9cd7501c67c13ad', '2022-05-27 01:40:30');

### URL for admin login page

`localhost/tenant-management-system/public/admin/login`

### Login credentials

username: 'admin'
password: 'admin'
