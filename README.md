# CoinGecko API

This project was built using Laravel 12 and Vue.js 3.

It is essentially a web page that displays 10 cryptocurrency assets and allows users to mark any of them as favorites.

The application includes error notifications and loading indicators.

There is a page that lists all 10 assets and another page that shows only the user’s favorite assets.

Additionally, there is a detail page, where users can view more information about a specific cryptocurrency along with a chart displaying its price history.

## Main dependencies
* PHP 8.4
* Node JS v22.18


## How to run the project

Set up the database connection in the .env file.

In one terminal run: 

```bash
php artisan migrate
php artisan octane:start --host=0.0.0.0 --port=8000
```

In another terminal run: 

```bash
npm run dev
```



## Extras
* Historical chart for an specific cryptocurrency on the details page.

