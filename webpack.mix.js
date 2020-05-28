const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/upload.js", "public/js")
    .js("resources/js/main.js", "public/js")
    .scripts(
        ["resources/js/user/UserWidget.js", "resources/js/user/userOption.js"],
        "public/js/user.js"
    )
    // .sass("resources/front/sass/app.scss", "public/front/css")
    .sass("resources/sass/app.scss", "public/css");
