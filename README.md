# Electronic Amateurs

A mini project with questions and answers for electronic enthusiasts.

## Setup

To get it working, follow these steps:

**Download Composer dependencies**

Make sure you have [Composer installed](https://getcomposer.org/download/)
and then run:

```
composer install
```

You may alternatively need to run `php composer.phar install`, depending
on how you installed Composer.

**Start the Symfony web server**

You can use Nginx or Apache, but Symfony's local web server
works even better.

To install the Symfony local web server, follow
"Downloading the Symfony client" instructions found
here: https://symfony.com/download - you only need to do this
once on your system.

Then, to start the web server, open a terminal, move into the
project, and run:

```
symfony serve -d
```

(If this is your first time using this command, you may see an
error that you need to run `symfony server:ca:install` first).

Now check out the site at `https://localhost:8000`

Have fun!

**Optional: Webpack Encore Assets**

This app uses Webpack Encore for the CSS, JS and image files. But
to keep life simple, the final, built assets are already inside the
project. So... you don't need to do anything to get thing set up!

If you *do* want to build the Webpack Encore assets manually, you
totally can! Make sure you have [yarn](https://yarnpkg.com/lang/en/)
installed and then run:

```
yarn install
yarn encore dev --watch
```





