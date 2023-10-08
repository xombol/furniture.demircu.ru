<?php

namespace App\Enums;

enum StatusesEnums: string
{
    case NEW = "new";
    case PROCESS = "process";
    case UPDATED = "updates";
    case SAVED = "saved";
    case PROCESSED = "processed";
}
