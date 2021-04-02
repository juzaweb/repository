<?php

namespace Theanh\Lararepo;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Theanh\Lararepo\Traits\ResponseMessage;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ResponseMessage;
}