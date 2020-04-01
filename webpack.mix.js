const mix = require('laravel-mix');
var tailwindcss = require('tailwindcss')
let glob = require('glob-all')
let PurgecssPlugin = require('purgecss-webpack-plugin')

class TailwindExtractor {
    static extract(content) {
        return content.match(/[A-Za-z0-9-_:\/]+/g) || []
    }
}

mix.js('resources/js/app.js', 'public/js')

mix.postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss'),
    require('autoprefixer'),
])

if (mix.inProduction()) {
    mix.version(); // Enable versioning.
    mix.webpackConfig({
        plugins: [
            new PurgecssPlugin({

                // Specify the locations of any files you want to scan for class names.
                paths: glob.sync([
                    path.join(__dirname, 'resources/views/**/*.blade.php'),
                    path.join(__dirname, 'resources/assets/js/**/*.js')
                ]),
                extractors: [
                    {
                        extractor: TailwindExtractor,

                        // Specify the file extensions to include when scanning for
                        // class names.
                        extensions: ['html', 'js', 'php']
                    }
                ]
            })
        ]
    })
}
