const mix = require('laravel-mix')
const exec = require('child_process').exec
require('dotenv').config()

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

const glob = require('glob')
const path = require('path')

/*
 |--------------------------------------------------------------------------
 | Vendor assets
 |--------------------------------------------------------------------------
 */

function mixAssetsDir(query, cb) {
    ; (glob.sync('resources/' + query) || []).forEach(f => {
        f = f.replace(/[\\\/]+/g, '/')
        cb(f, f.replace('resources', 'public'))
    })
}

const sassOptions = {
    precision: 5,
    includePaths: ['node_modules', 'resources/assets/']
}

if (!process.argv.includes("--watch") && !process.argv.includes("prod")) {
    mixAssetsDir('fonts', (src, dest) => mix.copy(src, dest))
    mixAssetsDir('fonts/**/**/*.css', (src, dest) => mix.copy(src, dest))

    // plugins Core stylesheets
    mixAssetsDir('scss/base/plugins/**/!(_)*.scss', (src, dest) =>
        mix.sass(src, dest.replace(/(\\|\/)scss(\\|\/)/, '$1css$2').replace(/\.scss$/, '.css'), { sassOptions })
    )

    // pages Core stylesheets
    mixAssetsDir('scss/base/pages/**/!(_)*.scss', (src, dest) =>
        mix.sass(src, dest.replace(/(\\|\/)scss(\\|\/)/, '$1css$2').replace(/\.scss$/, '.css'), { sassOptions })
    )

    // Core stylesheets
    mixAssetsDir('scss/base/core/**/!(_)*.scss', (src, dest) =>
        mix.sass(src, dest.replace(/(\\|\/)scss(\\|\/)/, '$1css$2').replace(/\.scss$/, '.css'), { sassOptions })
    )

    // script js
    mixAssetsDir('js/scripts/**/*.js', (src, dest) => mix.scripts(src, dest))

    /*
     |--------------------------------------------------------------------------
     | Application assets
     |--------------------------------------------------------------------------
     */

    mixAssetsDir('vendors/js/**/*.js', (src, dest) => mix.scripts(src, dest))
    mixAssetsDir('vendors/css/**/*.css', (src, dest) => mix.copy(src, dest))
    mixAssetsDir('vendors/css/editors/quill/fonts/', (src, dest) => mix.copy(src, dest))
    mixAssetsDir('vendors/**/**/images', (src, dest) => mix.copy(src, dest))
    mix.copyDirectory('resources/images', 'public/images')
}

mix.copyDirectory('resources/data', 'public/data')


if (mix.inProduction()) {
    mixAssetsDir('assets/js/*.js', (src, dest) => mix.js(src, dest.replace('assets/js', 'js/pages')))
} else {
    mix.copyDirectory('resources/assets/js/*', 'public/js/pages')
}

mix
    .js('resources/js/core/app-menu.js', 'public/js/core')
    .js('resources/js/core/app.js', 'public/js/core')
    .sass('resources/scss/base/themes/dark-layout.scss', 'public/css/base/themes', { sassOptions })
    .sass('resources/scss/base/themes/bordered-layout.scss', 'public/css/base/themes', { sassOptions })
    .sass('resources/scss/base/themes/semi-dark-layout.scss', 'public/css/base/themes', { sassOptions })
    .sass('resources/scss/core.scss', 'public/css', { sassOptions })
    .sass('resources/scss/overrides.scss', 'public/css', { sassOptions })
    .sass('resources/scss/base/custom-rtl.scss', 'public/css-rtl', { sassOptions })
    .sass('resources/assets/scss/style-rtl.scss', 'public/css-rtl', { sassOptions })
    .sass('resources/assets/scss/style.scss', 'public/css', { sassOptions })
    .options({ imgLoaderOptions: { enabled: false } })


mix.then(() => {
    if (process.env.MIX_CONTENT_DIRECTION === 'rtl') {
        let command = `node ${path.resolve('node_modules/rtlcss/bin/rtlcss.js')} -d -e ".css" ./public/css/ ./public/css/`
        exec(command, function (err, stdout, stderr) {
            if (err !== null) {
                console.log(err)
            }
        })
    }
})
mix.browserSync('localhost:8000');

if (mix.inProduction()) {
    mix.version()
}
