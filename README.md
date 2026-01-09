# Laravel E-Commerce Database Structure

This repository is an example of a complex Laravel database with migrations/models/factories/seeders.

The purpose is for developers to take this example and simulate various e-commerce scenarios, evaluate decisions about DB table relationships, and experiment with various Eloquent/SQL queries.

**Notice**: it's not an entire Laravel E-Commerce project. It's JUST the database layer.

This is the DB schema:

![](https://laraveldaily.com/uploads/2025/01/database-structure-min.png)

---

## There's Data Inside

With factories and seeders, you can play around with various scenarios, here are examples of a few DB tables after `php artisan migrate --seed`:

![](https://laraveldaily.com/uploads/2025/01/order-refunds-table-example.png)

![](https://laraveldaily.com/uploads/2025/01/orders-table-example.png)

![](https://laraveldaily.com/uploads/2025/01/product-table-example.png)

---

## Installation

Follow these steps to set up the project locally:

1. Clone the repository:
   ```bash
   git clone https://github.com/LaravelDaily/Laravel-Multi-Vendor-E-Commerce-Structure.git project
   cd project
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Copy the `.env` file and configure your environment variables:
   ```bash
   cp .env.example .env
   ```

4. Generate the application key:
   ```bash
   php artisan key:generate
   ```

5. Set up the database:
    - Update `.env` with your database credentials.
    - Run migrations and seed the database, repo includes fake tasks:
      ```bash
      php artisan migrate --seed
      ```

---

## Docker Setup (Alternative Installation)

If you prefer to run the project using Docker, follow these steps:

### Build and Start Containers
Run the following command in your terminal:
```bash
docker-compose up -d --build
```

### Xdebug Support
Xdebug is configured on port 9003 with idekey `PHPSTORM`.
If you enabled it after initial build, make sure to rebuild:
```bash
docker-compose down
docker-compose up -d --build
```

### Install Dependencies
Once the containers are up, install PHP dependencies:
```bash
docker-compose exec app composer install
```

### Run Migrations
Set up the database:
```bash
docker-compose exec app php artisan migrate
```

### Access the Application
Open your browser and navigate to:
[http://ecommerce.laravel.com](http://ecommerce.laravel.com)

**IMPORTANT**: You must add the following line to your hosts file:
- Windows: `C:\Windows\System32\drivers\etc\hosts`
- Linux/Mac: `/etc/hosts`

```
127.0.0.1 ecommerce.laravel.com
```

### Verification
Check running containers:
```bash
docker-compose ps
```
You should see `laravel-app`, `laravel-webserver`, and `laravel-db` running.

Check logs if needed:
```bash
docker-compose logs -f
```

---

## Troubleshooting & Useful Commands

Here is a list of commands that are helpful for debugging and managing the Docker environment:

### Verify Server Response
Check if the server is reachable and correct headers are being sent (useful if you haven't set up the hosts file yet or need to debug routing):
```bash
curl -I -H "Host: ecommerce.laravel.com" http://localhost
```
*Windows Powershell:*
```powershell
curl.exe -I -H "Host: ecommerce.laravel.com" http://localhost
```

### View Application Logs
See the last 20 lines of the Laravel application log file:
```bash
docker-compose exec app tail -n 20 storage/logs/laravel.log
```

### View Container Logs
See the logs from the `app` container (PHP-FPM, stdout/stderr):
```bash
docker-compose logs --tail=20 app
```

### Fix Permissions
If you encounter permission errors writing to storage or cache:
```bash
docker-compose exec app chmod -R 777 storage bootstrap/cache
```

### Generate Application Key
If you see an error about missing app key:
```bash
docker-compose exec app php artisan key:generate
```

---

## How it Works?

With this example, we wanted to show you how to structure a bigger application. In this case - an E-Commerce project.

You can find Database Seeders inside the repository, which will generate fake data for you:

**database/seeders/DatabaseSeeder.php**
```php
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,

            OrderStatusSeeder::class,
            OrderRefundStatusSeeder::class,
            OrderReturnStatusSeeder::class,
            OrderShipmentStatusSeeder::class,
            PaymentMethodSeeder::class,
            ProductStatusSeeder::class,
            EmailCampaignStatusSeeder::class,

            UserSeeder::class,
            UserAddressSeeder::class,

            VendorSeeder::class,

            ProductCategorySeeder::class,
            ProductAttributeSeeder::class,
            ProductSeeder::class,
            ProductReviewSeeder::class,

            OrderSeeder::class,

            PaymentVendorSeeder::class,
            VendorSettingsSeeder::class,
            VendorPaymentsSeeder::class,
            VendorReviewsSeeder::class,

            CouponSeeder::class,
            ReviewSeeder::class,
            WishlistSeeder::class,

            CartSeeder::class,
            CartItemSeeder::class,

            EmailCampaignSeeder::class,
            PromotionSeeder::class,
        ]);
    }
}
```

From here, you can play around with the data and see how to write specific queries to get the data you need or generate reports.

---

## DB Structure Decisions to Pay Attention To

We think these points below are interesting to analyze and learn from or experiment with alternatives.

1. Each of the User can have **multiple addresses**, and they are stored in separate table.
2. Products can have **multiple variations**, and they are stored in separate table.
3. We are using `decimal` for our prices, as it's more precise than `float`.
4. Order actions (like shipments, returns and refunds) are stored in separate tables.
5. Tracking Vendor commissions and payments is a separate table.
6. Usage of `restrict` on delete for some tables, like `products` and `order_items`. This means that if you have orders, you can't delete products.
7. Eloquent Casting usage for `datetime` fields