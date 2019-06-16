<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed currentPassword
 * @property mixed newPassword
 * @property mixed confirmPassword
 */
class ChangePasswordRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'currentPassword' => ['required'],
            'newPassword' => ['required', 'min:8', 'string'],
            'confirmPassword' => ['required', 'min:8', 'string'],
        ];
    }
}
