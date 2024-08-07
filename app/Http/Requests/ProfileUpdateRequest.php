<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
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
        // dd($this->all());
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];

        if ($this->input('password') || $this->input('password_confirmation')) {
            $rules['old_password'] = ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, $this->user()->password)) {
                    $fail('The old password is incorrect.');
                }
            }];

            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
            // $rules['confirm_password'] = ['required', 'string', 'same:password'];
        };

        return $rules;
    }
}
