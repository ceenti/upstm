<?php
namespace Ress\Controllers;

use BoxyBird\Inertia\Inertia;
use Ress\Inc\CollectYoastMeta;

class Single {
    public static function index() {
        // filter get_the_content so it return proper HTML tags
        $content = apply_filters( 'the_content', get_the_content());
        $author =  get_the_author_meta( 'display_name' , get_post()->post_author);

        return Inertia::render('Single', [
            'yoast_meta' => CollectYoastMeta::collectMeta(get_the_ID()),
            'title' => get_the_title(),
            'featured_image' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
            'date' => get_the_date(),
            'categories' => get_the_category(),
            'author' => $author,
            'content' => $content,
        ]);
    }
}
