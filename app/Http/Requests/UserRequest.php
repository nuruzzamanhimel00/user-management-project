<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = request()->route('user');
        $rules = [
            'name' => [ 'string', 'max:50'],
            'email' => ['required', 'string', 'max:50', Rule::unique('users')->ignore($id)],
            'password' => ['nullable', 'confirmed', 'min:6','max:10'],
            'role' => ['nullable'],
        ];
         // For update
         if (request()->isMethod('PUT')) {
            $rules['password'] = ['nullable'];
        }
        return $rules;
        // return [
        //     //
        // ];
    }
}
