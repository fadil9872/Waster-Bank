<?php

use App\Model\ApiCode;

return [
    /* 
        Code range setting
    */
    'min_code'      => 100,
    'max_code'      => 1024,
    
    /* 
        Error code to message mapping
    */
    'map'           => [
        ApiCode::SOMETHING_WENT_WRONG           => 'api.something_went_wrong',
        ApiCode::INVALID_CREDENTIALS            => 'api.invalid_credentials',
        ApiCode::VALIDATION_ERROR               => 'api.validation_error',
        ApiCode::INVALID_EMAIL_VERIFICATION_URL => 'api.invalid_email_verification_url',
        ApiCode::EMAIL_ALREADY_VERIFIED         => 'api.email_already_verified',
        ApiCode::INVALID_RESET_PASSWORD_TOKEN   => 'ai.invalid_reset_password_token',
    ],
]

?>