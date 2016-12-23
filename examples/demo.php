<?php

require_once __DIR__.'../vendor/autoload.php';

// Prepare the Afosto API Client
$oauthClientId = '';
$oauthClientSecret = '';

prepare_directory(__DIR__.'../tmp');
prepare_directory(__DIR__.'../tmp/oauth');

$storage = new \Afosto\ApiClient\Components\Storage\FileStorage([
    'directory' => __DIR__ . '/tmp/oauth/',
    'userKey' => 'dev',
]);

\Afosto\ApiClient\App::run($storage, $oauthClientId, $oauthClientSecret);

if (!\Afosto\ApiClient\App::getInstance()->hasToken()) {
    authorize();
    die();
}

// End prepare

// Create your Monolog instance
$logger = new \Monolog\Logger('afostologger-test');

// Create the Afosto handler and set the corresponding formatter
$handler = new \Afosto\Monolog\AfostoHandler();
$handler->setFormatter(new \Afosto\Monolog\AfostoFormatter());

// Add the handler to Monolog
$logger->pushHandler($handler);


function authorize() {
    if (isset($_GET['code'])) {
        //Obtain the code from the uri
        \Afosto\ApiClient\App::getInstance()->authorize($_GET['code']);
        echo 'Authorized, you can refresh the page as the accessToken is now stored in the cache';
    } else {
        //No code give, no authorzation in place, redirect to the application to
        //obtain grant
        header('Location: '.\Afosto\ApiClient\App::getInstance()->getAuthorizationUrl(
                'http://localhost:8080/test.php'
            ));
        echo 'You are being redirected';
    }
}

function prepare_directory($path) {
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }
}