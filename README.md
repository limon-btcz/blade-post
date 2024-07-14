# Blade Post

Blade post is a simple blog post app with laravel version 10.x & blade template. A simple application with authentication & Post CRUD functionality.

### Installation:
First clone the project to your machine.
```bash
git clone https://github.com/limon-btcz/blade-post.git
```
Go to the cloned project directory
```bash
cd blade-post
```

Install dependencies (You need composer installed in your machine)
```bash
composer install
```

setup your email smtp server & sql connection to the .env file.

then run 
```bash
php artisan queue:table
```

after that run,
```bash
php artisan migrate
```

For node packages run,
```bash
npm install
```

Now you ready to run the local server by,
```bash
php artisan serve
```
That will run a local server on port 9000. You can change the port number from the .env file.

In another terminal run,
```bash
npm run dev
```
For tailwind css.


And in another termainal run,
```bash
php artisan queue:work
```
For queue works. Like sending mail.

Now you are ready enjoy the Blade-Post application.

### Links
[laravel(10.x)](https://laravel.com/docs/10.x) \
[tailwindcss](https://tailwindcss.com)

## Contact
[facabook](https://www.facebook.com/limon.btcz) \
email: mdlimon0175@gmail.com