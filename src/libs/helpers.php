<?php

/**
 * Display a view
 *
 * @param string $filename
 * @param array $data
 * @return void
 */
function view(string $filename, array $data = []): void
{
    // create variables from the associative array
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    require_once __DIR__ . '/../inc/' . $filename . '.php';
}


/**
 * Return the error class if error is found in the array $errors
 *
 * @param array $errors
 * @param string $field
 * @return string
 */
function error_class(array $errors, string $field): string
{
    return isset($errors[$field]) ? 'error' : '';
}

/**
 * Return true if the request method is POST
 *
 * @return boolean
 */
function is_post_request(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
}

/**
 * Return true if the request method is GET
 *
 * @return boolean
 */
function is_get_request(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'GET';
}

/**
 * Redirect to another URL
 *
 * @param string $url
 * @return void
 */
function redirect_to(string $url): void
{
    header("Location:" . $url);
    exit;
}

/**
 * Redirect to another URL and the source where the redireced come from
 * @param bool $source
 * @param string $url
 * @return void
 */
function redirect_with_source(string $url, string $source): void
{
    $_SESSION['source'] = $source;
    header("Location:" . $url);
    exit;
}
/**
 * Redirect to a URL with data stored in the items array
 * @param string $url
 * @param array $items
 */
function redirect_with(string $url, array $items): void
{
    foreach ($items as $key => $value) {
        $_SESSION[$key] = $value;
    }

    redirect_to($url);
}

/**
 * Redirect to a URL with a flash message
 * @param string $url
 * @param string $message
 * @param string $type
 */
function redirect_with_message(string $url, string $message, string $type = FLASH_SUCCESS)
{
    flash('flash_' . uniqid(), $message, $type);
    redirect_to($url);
}

/**
 * Flash data specified by $keys from the $_SESSION
 * @param ...$keys
 * @return array
 */
function session_flash(...$keys): array
{
    $data = [];
    foreach ($keys as $key) {
        if (isset($_SESSION[$key])) {
            $data[] = $_SESSION[$key];
            unset($_SESSION[$key]);
        } else {
            $data[] = [];
        }
    }
    return $data;
}


/**
 * @param string $file  the path to the .env file
 * @return string       Value related to $param
 */
function get_config_value_from_env($file, $param)
{   
    $configValue = '';
    $envFile = __DIR__ . $file;

    // Check if the .env file exists
    if (file_exists($envFile)) {

        // Open the file and read its lines
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Iterate through the lines and look for the DB_PASSWD variable
        foreach ($lines as $line) {
            // Split the line into name-value pairs
            list($name, $value) = explode('=', $line, 2);

            // Remove whitespace and quotes
            $name = trim($name);
            $value = trim($value, " \t\n\r\0\x0B\"'");

            // Check if the name matches the desired variable
            if ($name === $param) {
                $configValue = $value;
                break; // Exit the loop once the variable is found
            }
        }
    } else {
       redirect_with_message(
            '/public/index.php',
            'Error in loading .env'
       );
    }
    return $configValue;
}


?>