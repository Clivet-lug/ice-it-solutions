﻿const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [
        require("tailwindcss"),
        require('autoprefixer'),
    ])

    // if (mix.inProduction()) {
    //     mix.version();
    // }

    .version();

mix.setPublicPath('public');

