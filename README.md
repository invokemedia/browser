# Browser

Browser Class
=============

A very simple class that takes in a user agent string and returns the browser name (Firefox, Chrome, Opera, etc.) and also the Operating System (Mac, Windows, Android, etc.).

### Reasons

Firstly, you *should not* use browser sniffing for fearture detection, [use Modernizr](https://modernizr.com/).

We mainly use this for style tweaks between different browsers. Or sometimes you may need to add a little script (differences in keystroke handling can be difficult to feature detect) or tweak on a specific platform combination and so you might do a check to see if that makes sense.

The results are pretty crude. We only return `internet-explorer` if any verison of IE is found. There is *no version information*.

For the platform, we only return that operation system. This means all iOS devices (iPad, iPhone, iPod) would only return `ios`.

If you need to know specifics about the device, [use media queries](http://stephen.io/mediaqueries/).

### Support

**Platforms**

* Linux
* iOS
* Mac
* Windows
* Android
* Blackberry

**Browsers**

* MSIE
* UC Browser
* Trident
* Vivaldi
* Firefox
* Chrome
* Opera
* Opera Mini
* Safari

### Usage

#### Methods

```
getBrowser() // returns the string for the browser
getPlatform() // returns the platform for the browser
isMobile() // returns true for android and ios platforms (except iPad)
isDesktop() // returns the opposite of isMobile()
```

#### Properties

```php
<?php

$browser = new Browser($_SERVER['HTTP_USER_AGENT']);
```

```php
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Browser Class</title>
  <style>
    body.google-chrome.mac {
      background: red;
    }
  </style>
</head>
<body class="<?php echo $browser->browser . ' ' . $browser->platform ?>">
  <!-- content -->
</body>
</html>
```

Results for Chrome on a Macbook:

```html
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Browser Class</title>
  <style>
    /* the body would now be red */
    body.google-chrome.mac {
      background: red;
    }
  </style>
</head>
<body class="google-chrome mac">
  <!-- content -->
</body>
</html>
```