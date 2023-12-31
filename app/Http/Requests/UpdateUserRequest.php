<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property int $user
 */
class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ["required"," string"],
            'last_name' => ["required"," string"],
            'email' => ["required", "email", Rule::unique('users')->ignore($this->user)],
        ];
    }
}
