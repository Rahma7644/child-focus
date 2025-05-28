<!-- BEGIN: Theme CSS-->
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700&display=swap" rel="stylesheet">

<style>
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    input,
    button,
    label,
    a,
    p,
    span {
        font-family: 'Almarai', sans-serif !important;
    }
</style>

@vite([
    'resources/assets/vendor/fonts/tabler-icons.scss',
    'resources/assets/vendor/fonts/fontawesome.scss',
    'resources/assets/vendor/fonts/flag-icons.scss',
    'resources/assets/vendor/libs/node-waves/node-waves.scss',
])
<!-- Core CSS -->
@vite([
    'resources/assets/vendor/scss' . $configData['rtlSupport'] . '/core' . ($configData['style'] !== 'light' ? '-' . $configData['style'] : '') . '.scss',
    'resources/assets/vendor/scss' . $configData['rtlSupport'] . '/' . $configData['theme'] . ($configData['style'] !== 'light' ? '-' . $configData['style'] : '') . '.scss',
    'resources/assets/css/demo.css'
])


<!-- Vendor Styles -->
@vite([
    'resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.scss',
    'resources/assets/vendor/libs/typeahead-js/typeahead.scss'
])
@yield('vendor-style')

<!-- Page Styles -->
@yield('page-style')
