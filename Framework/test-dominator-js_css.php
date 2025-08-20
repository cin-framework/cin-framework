<?php

declare(strict_types=1);

require_once __DIR__ . '/cin/cin.php';

dominator_style('style','style_2');

dominator_script('script','script_2');

dominator_style_url('https://www.example.com/style.css','https://example.com/style_2.css'); 

dominator_script_url('https://www.example.com/script.js','https://example.com/script_2.js');

dominator();
