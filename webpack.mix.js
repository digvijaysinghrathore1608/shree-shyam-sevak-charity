const mix = require('laravel-mix')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.copy('node_modules/datatables/media/images', 'public/assets/images')
mix.copyDirectory('resources/assets/images',
    'public/assets/images')
mix.copyDirectory('node_modules/intl-tel-input/build/img',
    'public/assets/css/inttel/img')

mix.copyDirectory('resources/theme/images', 'public/images')
mix.copyDirectory('resources/theme/webfonts', 'public/assets/webfonts')
mix.copyDirectory('resources/theme/fonts', 'public/assets/fonts')
mix.copy('public/front_landing/fonts', 'public/fonts')
mix.copy('public/front_landing/css/ajax-loader.gif',
    'public/css/ajax-loader.gif')

// backend third-party js
mix.scripts([
    'resources/theme/js/vendor.js',
    'resources/theme/js/plugins.js',
    'node_modules/intl-tel-input/build/js/intlTelInput.js',
    'node_modules/intl-tel-input/build/js/utils.js',
    'node_modules/apexcharts/dist/apexcharts.min.js',
    'node_modules/quill/dist/quill.js',
    'node_modules/dropzone/dist/dropzone-min.js',
    'node_modules/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js',
], 'public/js/third-party.js')

//backend page js
mix.js([
    'resources/assets/js/turbo.js',
    'resources/assets/js/custom/helpers.js',
    'resources/assets/js/custom/custom.js',
    'resources/assets/js/roles/roles.js',
    'resources/assets/js/settings/settings.js',
    'resources/assets/js/dashboard/dashboard.js',
    'resources/assets/js/dashboard/user-dashboard.js',
    'resources/assets/js/campaign-category/campaign-category.js',
    'resources/assets/js/campaign_faqs/campaign_faqs.js',
    'resources/assets/js/campaign_updates/campaign_updates.js',
    'resources/assets/js/news_comments/news_comments.js',
    'resources/assets/js/faqs/faqs.js',
    'resources/assets/js/users/user-profile.js',
    'resources/assets/js/events/event-participate.js',
    'resources/assets/js/second_front_slider/second_front_slider.js',
    'resources/assets/js/event-category/event-category.js',
    'resources/assets/js/brand/brand.js',
    'resources/assets/js/sidebar_menu_search/sidebar_menu_search.js',
    'resources/assets/js/users/user.js',
    'resources/assets/js/front_slider/front_slider.js',
    'resources/assets/js/campaigns/campaigns.js',
    'resources/assets/js/campaigns/create-edit.js',
    'resources/assets/js/success_story/success_story.js',
    'resources/assets/js/news_tags/news_tags.js',
    'resources/assets/js/news_tags/create_news_tags.js',
    'resources/assets/js/email_subscribe/create_email_subscribe.js',
    'resources/assets/js/countries/country.js',
    'resources/assets/js/pages/pages.js',
    'resources/assets/js/pages/create-edit.js',
    'resources/assets/js/inquiries/inquiries.js',
    'resources/assets/js/call_to_actions/call_to_actions.js',
    'resources/assets/js/events/event.js',
    'resources/assets/js/news_categories/news_categories.js',
    'resources/assets/js/news/news.js',
    'resources/assets/js/news/create-edit.js',
    'resources/assets/js/events/create-edit.js',
    'resources/assets/js/terms-conditions/terms-conditions.js',
    'resources/assets/js/third_front_slider/third_front_slider.js',
    'resources/assets/js/third_category/third_category.js',
    'resources/assets/js/teams/teams.js',
    'resources/assets/js/custom/phone-number-country-code.js',
    'resources/assets/js/languages/languages.js',
    'resources/assets/js/languages/language_translate.js',
    'resources/assets/js/user_withdraw/withdraw.js',
    'resources/assets/js/admin_withdraw/withdraw.js',
    'resources/assets/js/withdrawal/withdrawal.js',
    'resources/assets/js/donation_gifts/donation_gifts.js',
], 'public/js/pages.js')

mix.js('resources/assets/js/auth/auth.js', 'public/assets/js/auth/auth.js').
    version()

// front third-party js
mix.scripts([
    'public/front_landing/js/jquery.min.js',
    'public/front_landing/js/bootstrap.bundle.min.js',
    'public/front_landing/js/slick.min.js',
    'public/front_landing/js/owl.carousel.min.js',
    'node_modules/izitoast/dist/js/iziToast.min.js',
    'node_modules/moment/min/moment.min.js',
], 'public/js/front-third-party.js')

// front page js
mix.js([
    'resources/assets/js/custom/helpers.js',
    'resources/assets/js/news/news-category-filter.js',
    'resources/assets/js/front-side-index-page/index-page.js',
    'resources/assets/js/email_subscribe/email_subscribe.js',
    'resources/assets/js/front-side-campaigns/campaigns.js',
    'resources/assets/js/front-side-campaigns-details/campaigns-details.js',
    'resources/assets/js/front-side-about-us/about-us.js',
    'resources/assets/js/events/landing-event.js',
    'resources/assets/js/contact_us_form/contact_us_form.js',
    'resources/assets/js/call_to_actions/create_call_to_actions.js',
    'resources/assets/js/news_comments/create_news_comments.js',
], 'public/js/front-pages.js')

mix.js('resources/js/app.js', 'public/js').
    postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])

// backend third-party css
mix.styles([
    'resources/theme/css/third-party.css',
    'node_modules/intl-tel-input/build/css/intlTelInput.css',
    'node_modules/flatpickr/dist/flatpickr.css',
    'node_modules/quill/dist/quill.snow.css',
    'node_modules/dropzone/dist/dropzone.css',
    'node_modules/apexcharts/src/assets/apexcharts.css',
], 'public/css/third-party.css').version()

// light theme css
mix.styles('resources/theme/css/style.css', 'public/css/style.css')
mix.styles('resources/theme/css/plugins.css', 'public/css/plugins.css')

// backend pages css
mix.sass('resources/assets/css/main.scss', 'public/css/pages.css').version()

// front third party css
mix.styles([
    'node_modules/izitoast/dist/css/iziToast.min.css',
    'public/front_landing/css/slick.css',
    'public/front_landing/css/slick-theme.css',
    'public/front_landing/css/owl.carousel.min.css',
    'public/front_landing/css/owl.theme.default.min.css',
    'public/front_landing/scss/bootstrap.css',

], 'public/css/front-third-party.css').version()


// front-pages css
mix.styles([
    'public/front_landing/scss/custom.css',
    'public/front_landing/scss/layout.css',
    // 'resources/assets/css/landing/front-custom.scss',
    // 'resources/assets/css/landing/custom.scss',
    'public/front_landing/scss/home.css',
    'public/front_landing/scss/about.css',
    'public/front_landing/scss/causes.css',
    'public/front_landing/scss/causes-details.css',
    'public/front_landing/scss/payment.css',
    'public/front_landing/scss/news.css',
    'public/front_landing/scss/news-details.css',
    'public/front_landing/scss/events.css',
    'public/front_landing/scss/events-details.css',
    'public/front_landing/scss/contact.css',
], 'public/css/front-pages.css')

mix.sass('resources/assets/css/landing/front-custom.scss','public/css/front-custom.css');























