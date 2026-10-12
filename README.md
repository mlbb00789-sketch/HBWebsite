# 🏨 Hotel Booking Management System

A web-based Hotel Booking Management System that allows
+users to:
-User login and registration
-book hotel rooms
-Check booking availability
-Cancel Bookings
-Give review and ratings of booked rooms
-Profile management
-Online payment(BAKONG_DEMO).

+Admins can:
-manage Room (Add,modify,delete details)
-Manage users(view,ban,unban),
-Booking Management(Arrival status, Refund on cancellation, Finalize booking,Generate invoice)
-Room Features Management(Add, Modify, Delete)
-Room Services Management(Add, Modify, Delete)
-Review & Rating Management
-Shutdown Website

---

## 🚀 Features

- User registration and login
- Browse and search available rooms
- Book, view, and cancel reservations
- Admin dashboard to manage rooms and bookings
- Manage guest records
- View booking history

---

## 🛠️ Technologies Used

| Layer    | Technology                               |
| -------- | ---------------------------------------- |
| Frontend | HTML, CSS, JavaScript, Ajax, Bootstrap 5 |
| Backend  | PHP                                      |
| Database | MySQL                                    |
| Server   | XAMPP (Apache + MySQL)                   |

---

## ⚙️ Requirements

Before running this project, make sure you have:

- [XAMPP](https://www.apachefriends.org/index.html) installed (v7.4 or higher recommended)
- A web browser (Chrome, Firefox, etc.)

---

## 📦 How to Run the Project

Follow these steps carefully:

### 1. Clone or Download the Project

Download the project folder and place it inside your XAMPP `htdocs` directory:

```
C:/xampp/htdocs/hbwebsite/
```

### 2. Start XAMPP

- Open the **XAMPP Control Panel**
- Start **Apache** and **MySQL**

### 3. Import the Database

- Open your browser and go to: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
- Create a new database named: `hbwebsite`
- Click **Import** and select the file In Folder DATABASE: `DATABASE_FILE/hbwebsite.sql`
- Click **Go** to import

### 4. Configure Database Connection

- Open the file: `admin/inc/config/db_config.php`
- Make sure the settings match:

```php
$hname = "127.0.0.1";
$uname = 'root';
$pass = '';        // Leave empty if no password set
$db = 'hbwebsite';
$port = 3306;
```

### 5. Open the Project

- Go to your browser and visit: [http://localhost/hbwebsite/](http://localhost/hbwebsite/)

---

## 🔑 Login Credentials

### Guest / User Account

| Field    | Value                      |
| -------- | -------------------------- |
| URL      | http://localhost/hbwebsite |
| Email    | Penghongtesting@gmail.com  |
| Password | 1234                       |

### Admin Account

| Field      | Value                             |
| ---------- | --------------------------------- |
| URL        | http://localhost/hbwebsite/admin/ |
| Admin Name | penghong                          |
| Password   | 123                               |

### If you try to register and your data is not inserting in database, then check the network tab for error.

All you have to do is:

1. Open console window & go to network tab
2. Try to do a registration
3. After form submission, you will see an ajax call network tab to file "login_register.php"
4. Click on it to see the error.
5. If error is something like this -> Fatal error: Uncaught Error: Call to undefined function imagecreatefromjpeg()
6. Then to solve this you need to go in "C://xampp/php/php.ini" Configuration file
   -> Ignore php.ini-development or php.ini-production, Just open "php" named Configuration file
7. Search for "extension=gd" and if it has ";" (semicolon) then remove semicolon
   -> From ;extension=gd to extension=gd
8. That's it. But if you are using php8 then go to "C://php8/php.ini" Configuration file and repeat step 7
