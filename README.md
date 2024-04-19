# LTW Project - TechTudo

In this project we developed a website, TechTudo, that facilitates the buying and selling of pre-loved phones

### Database and project UML diagram

![img](docs/UMLdiagram.png)

### Database

[Database Folder](./database)

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
