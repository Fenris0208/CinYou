<?php
session_start();
error_reporting(0);

require_once __DIR__ . '/libs/helpers.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/tmdb_api.php';
require_once __DIR__ . '/libs/flash.php';
require_once __DIR__ . '/libs/sanitization.php';
require_once __DIR__ . '/libs/validation.php';
require_once __DIR__ . '/libs/filter.php';
require_once __DIR__ . '/libs/connection.php';
require_once __DIR__ . '/libs/auth.php';
require_once __DIR__ . '/libs/movie.php';
require_once __DIR__ . '/libs/group.php';
require_once __DIR__ . '/libs/event.php';
require_once __DIR__ . '/libs/mail.php';
require_once __DIR__ . '/libs/users.php';

