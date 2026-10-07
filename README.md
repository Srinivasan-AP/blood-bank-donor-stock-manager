# Blood Bank Donor & Stock Manager

A Web Technology Lab project for managing fictional donor records, blood stock, and blood requests. The app includes a static HTML/CSS/JavaScript prototype and a PHP/MySQL version.

> Educational demo with sample data only. Not for real medical use.

## Run the dynamic version

1. Install XAMPP (Apache, PHP, and MySQL).
2. Copy this project folder into XAMPP's `htdocs` directory.
3. Start Apache and MySQL from the XAMPP control panel.
4. Open phpMyAdmin at `http://localhost/phpmyadmin` and import `stage-2-dynamic/database/blood_bank.sql`.
5. Open `stage-2-dynamic/config.php` and update database settings if your local MySQL credentials differ.
6. Visit `http://localhost/blood-bank-manager/stage-2-dynamic/`.

The static prototype runs by opening `stage-1-static/index.html` in a browser. Its forms use browser-side demo behavior and do not save to a database.

## Features

- Dashboard summaries and low-stock warnings
- Donor add, search, edit, and delete
- Blood group stock levels for all eight groups
- Blood request creation and status updates
- PDO prepared statements, server-side validation, output escaping, and CSRF tokens

## GitHub

This project has its own repository: `Srinivasan-AP/blood-bank-donor-stock-manager`. Do not add real donor or patient information.
