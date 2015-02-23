<?php

namespace kcfinder;

chdir(__DIR__);
chdir("..");
chdir("..");
require "core/autoload.php";
$theme = basename(dirname(__FILE__));
$min = new minifier("css");
$min->minify("cache/theme_$theme.css", __DIR__);

?>