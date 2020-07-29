<?php

require_once get_template_directory().'/functions_ext.php'; // скрипт с кодом функций

/**
 * Отключение автоформатирования
 */
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
remove_filter('comment_text', 'wpautop');

/**
 * Подключение фич
 */
add_action('after_setup_theme', function() {

    // копирование файлов русского языка в общую папку Вордпресса с языковыми файлами
    if (!file_exists(ABSPATH.'wp-content/languages/themes/ipcustom-ru_RU.mo') && file_exists(get_template_directory().'/lang/ipcustom-ru_RU.mo')) file_put_contents(ABSPATH.'wp-content/languages/themes/ipcustom-ru_RU.mo', file_get_contents(get_template_directory().'/lang/ipcustom-ru_RU.mo'));

    if (!file_exists(ABSPATH.'wp-content/languages/themes/ipcustom-ru_RU.po') && file_exists(get_template_directory().'/lang/ipcustom-ru_RU.po')) file_put_contents(ABSPATH.'wp-content/languages/themes/ipcustom-ru_RU.po', file_get_contents(get_template_directory().'/lang/ipcustom-ru_RU.po'));

    // подключение поддержки языков
    load_theme_textdomain('ipcustom');

    // добавление динамически сгенерированного тега title в код страницы
    add_theme_support('title-tag');

    // добавление возможности менять лого через настройки темы
    add_theme_support('custom-logo', ['height' => 36, 'width' => 330, 'flex-height' => true]);

    // подключение возможноти добавлять миниатюры записям
    add_theme_support('post-thumbnails');
    // определение размера миниатюр
    set_post_thumbnail_size(562, 288);

    // подключение возможностей HTML5
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);

    // подключение типов записей
    add_theme_support('post-formats', ['aside', 'image', 'video', 'gallery']);

    // регистрация локального меню
    register_nav_menu('primary', 'Primary menu');

});

/**
 * подключение CSS и JS
 */
add_action('wp_enqueue_scripts', function() {

    // загрузка необходимых файлов для темы
    if (!file_exists(get_template_directory().'/js/jquery-3.5.1.js')) file_put_contents(get_template_directory().'/js/jquery-3.5.1.js', file_get_contents('https://code.jquery.com/jquery-3.5.1.js'));

    if (!file_exists(get_template_directory().'/css/bootstrap.min.css')) file_put_contents(get_template_directory().'/css/bootstrap.min.css', file_get_contents('https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css'));

    if (!file_exists(get_template_directory().'/js/popper.min.js')) @file_put_contents(get_template_directory().'/js/popper.min.js', file_get_contents('https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'));

    if (!file_exists(get_template_directory().'/js/bootstrap.min.js')) file_put_contents(get_template_directory().'/js/bootstrap.min.js', file_get_contents('https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js'));

    // таблица стилей Bootstrap
    wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.min.css');
    // таблица стилей темы
    wp_enqueue_style('style', get_template_directory_uri().'/style.css');

    // подключение JQuery 3.5.1
    wp_enqueue_script('jquery-3.5.1', get_template_directory_uri().'/js/jquery-3.5.1.js');

    // подключение Popper JS, необходимого для Bootstrap
    wp_enqueue_script('popper', get_template_directory_uri().'/js/popper.min.js');
    // подключение JS-скриптов Bootstrap
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js');
    // подключение JS-скриптов темы
    wp_enqueue_script('script', get_template_directory_uri().'/js/script.js');

});

/**
 * Фильтрация HTML-кода пунктов меню
 */
add_filter('wp_nav_menu_items', function($items, $args) {

    // добавление класса к ссылкам в пунктах меню
    $items = str_replace('a href', 'a class="nav-link" href', $items);

    // очистка ссылок от обёрток тегом <li></li>, т.е. оставляем только сам код ссылок
    $result = '';

    while (strpos($items, '<a class="nav-link" href') !== false) {

        $items = substr($items, strpos($items, '<a class="nav-link" href'));

        $result .= substr($items, 0, strpos($items, '</a>')).'</a>'."\n";

        $items = substr($items, strpos($items, '</a>') + 4);

    }

    $link = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    if (strpos($result, 'href="'.$link.'"') !== false) $result = str_replace('<a class="nav-link" href="'.$link.'"', '<a class="nav-link active" href="'.$link.'"', $result);

    return $result;

}, 10, 2);

/**
 * Фильтрация символов сокращения функции the_exceprt()
 * Теряет смысл при фильтрации самого открывка по хуку the_excerpt
 */
add_filter('excerpt_more', function($more) {

    return '...';

});

/**
 * Удаление заголовка пагинации
 */
add_filter('navigation_markup_template', function($template, $class) {

    return '
    <nav class="navigation %1$s" role="navigation">
        <div class="nav-links">%3$s</div>
    </nav>';

}, 10, 2);

/**
 * Сокращение отрывка поста до 30 слов
 */
add_filter('the_excerpt', function($post_excerpt) {

    $post_excerpt = explode(' ', $post_excerpt);

    $result = '';

    if (!empty($post_excerpt)) {

        $count = 0;

        foreach ($post_excerpt as $word) {
            
            $count += 1;

            if ($count === 1) $result = $word;
            else $result .= ' '.$word;

            if ($count === 30) break;

        }

        $result .= '...';

    }

    return $result;

});

/**
 * Добавление в кастомайзер настроек ссылки на разработчика
 */
add_action('customize_register', function($wp_customize) {

    $wp_customize->add_section('developer_section', [
        'title' => esc_html__('Developer link in footer', 'ipcsutom'),
        'priority' => 30
    ]);

    $wp_customize->add_setting('text_before', [
        'default' => esc_html__('Developed by', 'ipcustom'),
        'transport' => 'refresh'
    ]);

    $wp_customize->add_setting('link_text', [
        'default' => esc_html__('Noisier', 'ipcustom'),
        'transport' => 'refresh'
    ]);

    $wp_customize->add_setting('developer_link', [
        'default' => 'https://github.com/drnoisier',
        'transport' => 'refresh'
    ]);

    $wp_customize->add_control('text_before', [
        'label' => esc_html__('Text before link', 'ipcustom'),
        'section' => 'developer_section',
        'settings' => 'text_before',
        'type' => 'text'
    ]);

    $wp_customize->add_control('link_text', [
        'label' => esc_html__('Text in link', 'ipcustom'),
        'section' => 'developer_section',
        'settings' => 'link_text',
        'type' => 'text'
    ]);

    $wp_customize->add_control('developer_link', [
        'label' => esc_html__('Link', 'ipcustom'),
        'section' => 'developer_section',
        'settings' => 'developer_link',
        'type' => 'text'
    ]);

});
