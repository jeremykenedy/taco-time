## Taco Time

[![Build Status](https://travis-ci.org/jeremykenedy/taco-time.svg?branch=master)](https://travis-ci.org/jeremykenedy/taco-time)
[![StyleCI](https://github.styleci.io/repos/149530311/shield?branch=master)](https://github.styleci.io/repos/149530311)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Simple example Laravel 5.7 app to calculate taco checkout time using a VueJS 2 front end calling Laravel API endpoints.

#### Table of contents
- [About](#about)
- [Features](#features)
- [Installation Instructions](#installation-instructions)
    - [Manual Install](#manual-install)
    - [Automatic Install](#automatic-install)
    - [Build the Front End Assets with Mix](#build-front-end-assets-with-mix)
- [Routes](#routes)
- [Screenshots](#screenshots)
- [File Tree](#file-tree)
- [License](#license)

### About
Simple example Laravel app to calculate taco checkout time using a VueJS front end calling Laravel API endpoints.
It's Taco Tuesday, and there is a line of people who need tacos, and they need to know when.
Calculate the total time required for all the customers to place their order!  


### Features
| Taco Time Features  |
| :------------ |
|Built on [Laravel](http://laravel.com/) 5.7|
|Built on [Bootstrap](https://getbootstrap.com/) 4|
|Front End Uses [VueJs](https://vuejs.org/v2/guide/) and [VueDraggable](https://github.com/SortableJS/Vue.Draggable)|
|Full Unit Test Coverage with [PHPUnit](https://laravel.com/docs/5.7/testing)|

### Installation Instructions
##### Manual Install:
1. Run `git clone https://github.com/jeremykenedy/taco-time.git taco-time`
2. From the projects root run `cp .env.example .env`
3. Run `composer update` from the projects root folder
4. From the projects root folder run `php artisan key:generate`
5. Compile the front end assets with [yarn](#using-yarn) or [npm](#using-npm).
6. From the projects root folder run `php artisan serve`

##### Automatic Install:
1. Run `git clone https://github.com/jeremykenedy/taco-time.git taco-time`
2. From the projects root run `. taco-install.sh`
3. Open your browser to `http://127.0.0.1:3000/`

#### Build the Front End Assets with Mix
##### Using Yarn:
1. From the projects root folder run `yarn install`
2. From the projects root folder run `yarn run dev` or `yarn run production`
  * You can watch assets with `yarn run watch`

##### Using NPM:
1. From the projects root folder run `npm install`
2. From the projects root folder run `npm run dev` or `npm run production`
  * You can watch assets with `npm run watch`

### Routes

```
+----------+--------------+----------+---------------------------------------------------+------------+
| Method   | URI          | Name     | Action                                            | Middleware |
+----------+--------------+----------+---------------------------------------------------+------------+
| GET|HEAD | /            |          | App\Http\Controllers\HomeController@index         | web        |
| POST     | api/tacotime | tacotime | App\Http\Controllers\OrderController@getlineTimes | api        |
+----------+--------------+----------+---------------------------------------------------+------------+
```

### Screenshots
![Taco Test Case 1](https://s3-us-west-2.amazonaws.com/taco-time/taco1.jpg)
![Taco Test Case 2](https://s3-us-west-2.amazonaws.com/taco-time/taco2.jpg)

### File Tree

```
Taco Time
├── app
│   └── Http
│       └── Controllers
│           └── OrderController.php
├── package.json
├── public
├── resources
│   ├── js
│   │   ├── app.js
│   │   └── components
│   │       └── TacoTime.vue
│   └── views
│       ├── home.blade.php
│       └── layouts
│           └── app.blade.php
├── routes
│   ├── api.php
│   └── web.php
├── tests
│   └── Unit
│       └── LineTimeTest.php
└── webpack.mix.js
```

### License
Taco Time is licensed under the [MIT license](https://opensource.org/licenses/MIT). Enjoy!
