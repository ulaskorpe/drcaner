let mix = require('laravel-mix');
require('dotenv').config();

mix.js('resources/js/app.js', 'js')
    .extract()
    .vue(3)
    .sass('resources/css/app.scss', 'public/css')
    .version();

mix.copy('./node_modules/bootstrap-icons/font/fonts/*', 'public/css/fonts');
mix.copy('./node_modules/primevue/resources/themes/lara-light-blue/fonts/*', 'public/css/fonts');

mix.sass('resources/css/primevue-light.scss', 'css')
    .version();

mix.sass('resources/css/primevue-dark.scss', 'css').version();

//FE
mix.combine([
    './node_modules/bootstrap/dist/js/bootstrap.bundle.js',
    './node_modules/masonry-layout/dist/masonry.pkgd.js',
    './node_modules/universal-parallax/dist/universal-parallax.js',
    './node_modules/@fancyapps/ui/dist/fancybox/fancybox.umd.js',
    './node_modules/swiper/swiper-bundle.min.js',
    //'./node_modules/sweetalert2/dist/sweetalert2.all.js',
    //'./node_modules/tom-select/dist/js/tom-select.complete.js',
    //'./node_modules/mixitup/dist/mixitup.min.js',
    //'./resources/fe/vendors/FreezeUI/freeze-ui.min.js',
    //'./node_modules/simplebar/dist/simplebar.js',
    //'./node_modules/pikaday/pikaday.js',
    //'./resources/fe/vendors/bootstrap5-tags.js',
], './public/fe/js/vendors.js').version().sourceMaps();

mix.combine([
    './resources/fe/js/main.js',
    './resources/fe/js/theme.js',
], './public/fe/js/main.js').version().sourceMaps();

mix.options({
    processCssUrls: false // CSS içindeki URL'leri işleme
 });

mix.sass('./resources/fe/css/vendors.scss', 'public/fe/css').version();
mix.sass('./resources/fe/css/main.scss', 'public/fe/css').version();
//mix.sass('./resources/fe/css/main_full.scss', 'public/fe/css').version();
mix.copy('./node_modules/bootstrap-icons/font/fonts/*', 'public/fe/css/fonts'); //bu fe icin
mix.copy('./resources/fe/css/fonts', 'public/fe/css/fonts');