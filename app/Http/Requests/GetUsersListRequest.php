<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Dictionaries\SortDirection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetUsersListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page' => ['integer', 'min:1'],
            'perPage' => ['integer', 'min:1'],
            'sortField' => ['string'],
            'sortDirection' => [Rule::enum(SortDirection::class)],
            'first_name' => ['string'],
            'last_name' => ['string'],
            'email' => ['email'],
        ];
    }
}
