<?php

namespace Ress\Controllers;

use BoxyBird\Inertia\Inertia;
use Ress\Inc\CollectYoastMeta;

class ExitPage
{
  public static function index()
  {
    return Inertia::render('ExitPage', [
      'yoast_meta' => CollectYoastMeta::collectMeta(get_the_ID()),
    ]);
  }
}
