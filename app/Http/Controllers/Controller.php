<?php

namespace App\Http\Controllers;

use Spatie\Permission\Exceptions\UnauthorizedException;

abstract class Controller {
    public function authorize($permission) {
        if (!auth()->user()->can($permission)) {
            throw new UnauthorizedException(401, "You don't have the permission to $permission");
        };
    }
}
