<?php

use App\Controllers\IndexController;
use Dependencies\Route\Route;

Route::get("/", [IndexController::class, "index"]);
