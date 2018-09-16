## Taco Time
Simple Laravel app to calculate taco checkout time.

#### Table of contents
- [About](#about)
- [Features](#features)
- [Installation Instructions](#installation-instructions)
    - [Build the Front End Assets with Mix](#build-front-end-assets-with-mix)
- [Routes](#routes)
- [Screenshots](#screenshots)
- [File Tree](#file-tree)

### About
It's Taco Tuesday, and there is a line of people who need tacos. Your task is write a function, a class, or classes to calculate the total time required for all the customers to place their order!  

### Features
| Taco Time Features  |
| :------------ |
|Built on [Laravel](http://laravel.com/) 5.7|
|Built on [Bootstrap](https://getbootstrap.com/) 4|
|Front End Uses [VueJs](https://vuejs.org/v2/guide/) and [VueDraggable](https://github.com/SortableJS/Vue.Draggable)|
|Full Unit Test Coverage with [PHPUnit](https://laravel.com/docs/5.7/testing)|

### Installation Instructions
1. Run `git clone git@bitbucket.org:jeremykenedy/taco-time.git taco-time`
2. From the projects root run `cp .env.example .env`
3. Configure your `.env` file
4. Run `composer update` from the projects root folder
5. From the projects root folder run `php artisan key:generate`
6. Compile the front end assets with [yarn](#using-yarn) or [npm](#using-npm).

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
