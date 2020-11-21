<?php

require __DIR__.'/vendor/autoload.php';

$theme = \App\Theme::instance();

$theme->autoloadDirectory(__DIR__.'/inc');
