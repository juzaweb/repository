<?php

namespace Tadcms\Lararepo;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Tadcms\Lararepo\Traits\ResponseMessage;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ResponseMessage;
}