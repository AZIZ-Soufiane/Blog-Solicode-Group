<?php

use Illuminate\Support\Facades\Storage;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Testing Storage::url():\n";
echo "Input: 'images/articles/test.jpg'\n";
echo "Output: " . Storage::url('images/articles/test.jpg') . "\n";
