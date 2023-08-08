<?php 

use Ress\Inc\Collecter;
use Ress\Controllers\FrontPage;
use Ress\Controllers\Single;
use Ress\Controllers\Page;
use Ress\Controllers\Archive;
use Ress\Controllers\Blog;
use Ress\Controllers\ExitPage;
use BoxyBird\Inertia\Inertia;

if (is_front_page()) {
    return FrontPage::index();
}

if (is_single() && 'post' == get_post_type()) {
    return Single::index();
}

if (is_page('blog')) {
    return Blog::index();
}

if (is_page('exit')) {
    return ExitPage::index();
}

if (is_page()) {
    return Page::index();
}

if (is_archive() && 'post' == get_post_type()) {
    return Archive::index();
}

if (is_404()) {
    return Inertia::render('Page404', [
        'content' => '404 - Not Found',
    ]);
}
