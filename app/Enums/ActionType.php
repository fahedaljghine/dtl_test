<?php

namespace App\Enums;

enum ActionType: string
{
case CREATE = 'create';
case UPDATE = 'update';
case DELETE = 'delete';
case RESTORE = 'restore';
case FORCE_DELETE = 'force_restore';
}
