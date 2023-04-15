> _Note_
>
> This queue driver is designed for Snappfood interview and only Lumen framework supports it.

## Installation

```shell
composer require vkoori/identifier-queue
```

## Registere service providers

Add this lines to `bootstrap/app.php` file.

```shell
$app->register(\Kooriv\Queue\Providers\QueueServiceProvider::class);
```

## Create database table

```shell
php artisan queue:identifier-table

php artisan migrate
```

> **Note**
>
> This table is fully compatible with the Lumen database driver. So don't be afraid when using this table.

## Dispatching job

You can dispatch your jobs in the queue using the helper function below

```shell
dispatcher(new ExampleJob)->onConnection("connection")->onQueue("queue")->setIdentifier("identifier");
```

> **Note**
>
> If you want to set an `identifierCode`, your job must have use following trait:

```shell
use \Kooriv\Queue\Illuminate\Bus\Trait\IdentifierCode;
```

> **Note**
>
> Using this helper function will not cause any damage to other drivers.
