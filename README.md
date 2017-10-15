# Flashy
Beautiful alert component made with VueJs for Laravel app.

## Overview
![Flashy](https://i.imgur.com/ILVXAZA.gif)

## Installation

### Step 1: Composer
From the command line, run:

```bash
composer require devmi/flashy
```

### Step 2: Service Provider
> If you're using laravel >5.5 skip to the next step.

Open config/app.php and within the providers array:

```
Devmi\Flashy\FlashyServiceProvider::class
```

### Step 3: Vendor Puslish

Now you must publish the vue compenent and register it in order to use it.

```
php artisan vendor:publish --tag=devmi
```
open `resources/assets/js/app.js` and register the component
```
Vue.component('flashy', require('./vendor/devmi/Flashy.vue'));
```

you find the file under `resources/assets/js/vendor/devmi/Flashy.vue`.

### Step 3: Add Flashy Tag

You can add the flashy component anywhere in your blade files but preferably
it should be added to your `app.blade.php` file
```
<flashy data-message="{{ flashy()->message() }}"></flashy>
```

## Usage
Now in your controller before any redirect you may do
```
flashy()->push('This message will be flashed.');
```


> The default color is bootstrap alert success.

### More Control
You may also change the default theme color, display delay, add title, stop animation

`app.blade.php`
```
<flashy
    data-title="{{ flashy()->title() }}"
    data-message="{{ flashy()->message() }}"
    data-type="{{ flashy()->type() }}"
    data-delay="3000"
    :data-animated="true">
</flashy>
```
And
```
flashy()->push('This message will be flashed.', 'Title', 'Info');
```

>**Title:** `String` (optional)

>**Message:** `String`

>**Type:**  `string` eg: `['success', 'info', 'danger', 'warning', 'primary', 'secondary', 'light', 'dark']` (optional)  | **Default:** `success`


>**Delay:** `Integer` (optional) | **Default:** `3000`

>**Animated:** `Boolean` (optional) | **Default:** `true`

### Notice
If you use Ajax requests, you should add to `resources/assets/js/app.js` the following code

```
window.events = new Vue();
window.flashy = (message, title, type) => window.events.$emit('flashy', message, title, type)
```
then simply you can call `flashy()` global function from any `.vue` file and pass you arguments.


## Issues and Contribution
If you find any bug or problem please open an issue or create a pull request, Thanks!.
