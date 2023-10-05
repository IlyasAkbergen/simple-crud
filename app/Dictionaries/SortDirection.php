<?php

declare(strict_types=1);

namespace App\Dictionaries;

enum SortDirection: string
{
    case ASC = 'asc';
    case DESC = 'desc';
}
