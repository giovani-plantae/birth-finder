# Birth Finder

This is a testing project aimed at finding upcoming birthdays within a specified range of n days while striving for cleanliness and readability.

## Project Setup

The project is set up using a fresh installation of Laravel, with the only modification being the addition of the 'birth' field to the user table. Adjustments to user factory to include the generation of random birth dates, and the command `birthdays:upcoming {duration}` to help the execution.


## Usage

Open Tinker:
```sh
php artisan tinker
```

Seed the Database:
```php
User::factory()->count(5000)->create();
```

Run the following command to find upcoming birthdays within a specified duration:
```sh
php artisan birthdays:upcoming {duration}
```
Ensure that the `duration` parameter is provided in ISO format like `P7D`, `P1M`...
