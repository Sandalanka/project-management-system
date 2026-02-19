<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Signature Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the JWT library to sign your authentication tokens.
    | It should be a long, random string to ensure the security of your
    | application. Keeping this secret is vital for preventing forgery.
    |
    | Default: 'yourauthsecretkey' (It is highly recommended to use a .env variable)
    |
    */
    'api-token' => env('API_TOKEN', 'api-token')
];