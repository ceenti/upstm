<?php

namespace Ress\Controllers;

use BoxyBird\Inertia\Inertia;
use Ress\Inc\CollectYoastMeta;

class Blog
{
  public static function index()
  {
    $posts_per_page = 9;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $category_slug = (isset($_GET['category'])) ? $_GET['category'] : ''; // get category slug from query string

    $args = array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => $posts_per_page,
      'category_name' => $category_slug,
      'paged' => $paged
    );

    $query = new \WP_Query($args);

    // Build $posts array
    $posts = array_map(function ($post) {
      return [
        'id'      => $post->ID,
        'title'   => get_the_title($post->ID),
        'link'    => get_the_permalink($post->ID),
        'image'   => get_the_post_thumbnail_url($post->ID),
        'excerpt' => get_the_excerpt($post->ID),
        'content' => apply_filters('the_content', get_the_content(null, false, $post->ID)),
        'categories' => get_the_category($post->ID),
        'tags' => get_the_tags($post->ID),
      ];
    }, $query->posts);

    // Build $pagination array
    $current_page = max(1, $paged);
    $prev_page    = $current_page > 1 ? $current_page - 1 : false;
    $next_page    = $current_page < $query->max_num_pages ? $current_page + 1 : false;

    $pagination = [
      'prev_page'    => $prev_page,
      'next_page'    => $next_page,
      'current_page' => $current_page,
      'total_pages'  => $query->max_num_pages,
      'total_posts'  => (int) $query->found_posts,
      'prev_page_url' => $prev_page ? get_pagenum_link($prev_page) : false,
      'next_page_url' => $next_page ? get_pagenum_link($next_page) : false,
    ];

    return Inertia::render('Blog', [
      'yoast_meta' => CollectYoastMeta::collectMeta(get_the_ID()),
      'title'      => 'Blog',
      'posts'      => $posts,
      'pagination' => $pagination,
      'categories' => get_categories(),
      'current_category' => $category_slug, // add current category to the view data
    ]);
  }
}
