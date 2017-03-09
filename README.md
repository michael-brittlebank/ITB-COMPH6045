# H6045 - Web Development #

## How to run the website ##

The website is built upon PHP and the [Slim](https://www.slimframework.com/) routing framework.  [Composer](https://getcomposer.org/), [NPM](https://www.npmjs.com/), and [Bower](https://bower.io/) are used to manage project dependencies (installation commands only need to be run once).  [Grunt](http://gruntjs.com/) compiles the frontend CSS and JS files.  The code is under version control in [Github](https://github.com/mike-stumpf/ITB-COMPH6044).

After cloning the repo, run
```
cp .env_example .env
composer install
npm install
bower install
grunt build
```


## How to develop the frontend JS and CSS files ##

Grunt monitors changes and rebuilds the compiled files as needed.  [Live Reload](https://chrome.google.com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei?hl=en) can be used for automated page refreshes once the builds are complete.  In the root of the project, run
```
grunt dev
```