<?php

use App\RandomNumber;

return [
    '/generate/' => RandomNumber::class,
    '/retrieve\/([\d]+)\//m' => null,    // Not implemented
];