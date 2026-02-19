<?php

namespace App\Constant;

class Status
{
    //pending status
    const PENDING = 'pending';

    //done status
    const DONE = 'done';

    //in progress status
    const IN_PROGRESS = 'in_progress';

    //ok
    const STATUS_CODE_OK = 200;

    //created
    const STATUS_CODE_CREATED = 201;

    //unauthorized
    const STATUS_CODE_UNAUTHORIZED = 401;

    //forbidden
    const STATUS_CODE_FORBIDDEN = 403;

    //unprocessable entity
    const STATUS_CODE_UNPROCESSABLE_ENTITY = 422;

    //Internal server error
    const STATUS_CODE_INTERNAL_SERVER_ERROR = 500;

    //status
    const STATUS_SUCCESS = 'success';

    //failed
    const STATUS_FAILED = 'failed';
}
