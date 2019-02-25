<?php
declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ChangePasswordRequest
 * @package App\Http\Requests\User
 */
class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'old_password' => 'required|string|between:3,32',
            'password' => 'required|string|between:3,32|confirmed',
        ];
    }

    /**
     * @return string
     */
    public function oldPassword(): string
    {
        return (string)$this->get('old_password', '');
    }

    /**
     * @return string
     */
    public function newPassword(): string
    {
        return (string)$this->get('password', '');
    }
}
