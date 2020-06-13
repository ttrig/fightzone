const mix = require('laravel-mix')

mix.js('resources/js/app.js', 'public/js')
mix.js('resources/js/schedule.js', 'public/js')
mix.js('resources/js/admin.js', 'public/js')
mix.js('resources/js/admin-text-edit.js', 'public/js')

mix.sass('resources/sass/app.scss', 'public/css')
mix.sass('resources/sass/schedule.scss', 'public/css')
mix.sass('resources/sass/partners.scss', 'public/css')
mix.sass('resources/sass/admin-tinymce.scss', 'public/css')
mix.sass('resources/sass/admin.scss', 'public/css')

mix.copy('node_modules/tinymce/skins', 'public/tinymce/skins')
mix.copy('node_modules/tinymce/themes', 'public/tinymce/themes')
mix.copy('node_modules/tinymce/icons', 'public/tinymce/icons')

mix.autoload({
  jquery: ['$', 'jQuery', 'window.jQuery'],
})

mix.extract([
  'jquery',
  'popper.js',
  'bootstrap',
])

if (mix.inProduction()) {
    mix.version()
} else {
  mix.sourceMaps()
  mix.browserSync({
    proxy: '127.0.0.1:8000',
    open: false
  })
}
