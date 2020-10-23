<?php

use Illuminate\Support\Facades\Auth;

Auth::routes(['verify' => true]);

require_once __DIR__ . '/web.admin.php';
require_once __DIR__ . '/web.board.php';
require_once __DIR__ . '/web.client.php';
