<?php

declare(strict_types=1);

namespace App\Request\Auth;

use Hyperf\Validation\Request\FormRequest;

class WebLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'loginname' => 'required',
            'password' => 'required'
        ];
    }
}
