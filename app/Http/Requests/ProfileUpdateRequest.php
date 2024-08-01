<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'gender' => ['nullable', 'string', 'in:male,female,other'],
            'age' => ['nullable', 'integer',],
            'location_id' => ['nullable', 'integer', 'exists:locations,id'],
            // 'country' => ['nullable', 'string', 'max:255'],
            // 'city' => ['nullable', 'string', 'max:255'],
            'about' => ['nullable', 'string', 'max:255'],
            'interests' => ['nullable', 'array'],
            'interests.*' => ['integer', 'exists:interests,id'],
        ];
    }
}
