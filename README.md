# TechTudo

In this project we developed a website, TechTudo, that facilitates the buying and selling of pre-loved phones.

![img](docs/TechTudo_logo.png)

## Group ltw04g03

- Ricardo Parreira (up202205091) %
- Álvaro Torres (up202208954) %
- Guilherme Ferreira (up202207524) %

## Install Instructions

    git clone https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw04g03.git
    git checkout final-delivery-v1
    sqlite database/database.db < database/database.sql
    php -S localhost:9000

## Screenshots

(2 or 3 screenshots of your website)

## Database and project UML diagram

![img](docs/UMLdiagram.png)

## Database

[Database Folder](./database)

## Mockups

![img](docs/Mockups.jpg)

## Implemented Features

**General**:

- [ ] Register a new account.
- [ ] Log in and out.
- [ ] Edit their profile, including their name, username, password, and email.

**Sellers**  should be able to:

- [ ] List new items, providing details such as brand, model, a description of the product, condition, location, price, along with an image of the product.
- [ ] Track and manage their listed items.
??? - [ ] Respond to inquiries from buyers regarding their items and add further information if needed.
- [ ] Print shipping forms for items that have been sold.

**Buyers**  should be able to:

- [ ] Browse items using filters like category, price, and condition.
??? - [ ] Engage with sellers to ask questions or negotiate prices.
- [ ] Add items to a wishlist or shopping cart.
- [ ] Proceed to checkout with their shopping cart (simulate payment process).

**Admins**  should be able to:

- [ ] Elevate a user to admin status.
- [ ] Delete Ads.
- [ ] Oversee and ensure the smooth operation of the entire system.

**Security**:
We have been careful with the following security aspects:

- [ ] **SQL injection**
- [ ] **Cross-Site Scripting (XSS)**
- [ ] **Cross-Site Request Forgery (CSRF)**

**Password Storage Mechanism**: hash_password&verify_password

### Transactions

//TODO
To make the process dynamic, you would typically build a web application with a user interface that allows users to list their devices for sale, browse available devices, and initiate purchases. On the backend, your PHP classes would handle the database interactions.

Here's a simplified example of how this might work:

1. A user logs into your application and navigates to a "Sell Device" page.
2. The user fills out a form with the details of the device they want to sell (brand, model, storage, RAM, display size, etc.) and submits the form.
3. Your application takes the form data and uses the `Device` class to insert a new device into the `Device` table in your database.

```php
$device = new Device($pdo);
$device->addDevice($brand, $model, $storage, $ram, $displaySize);
```

4. When another user wants to buy a device, they would navigate to a "Buy Device" page, which displays a list of available devices.
5. The user selects a device and initiates a purchase.
6. Your application uses the `Transaction` class to insert a new transaction into the `Transaction` table, recording the details of the purchase.

```php
$transaction = new Transaction($pdo);
$transaction->addTransaction($deviceId, $buyerId, $sellerId, $price);
```

This is a very simplified example and a real-world application would need to handle many more details (like user authentication, form validation, error handling, etc.). But hopefully, this gives you a general idea of how the process could be made dynamic.

