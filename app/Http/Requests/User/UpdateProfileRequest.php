<?php
declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateProfileRequest
 * @package App\Http\Requests\User
 */
class UpdateProfileRequest extends FormRequest
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
            'address' => 'string|max:255|nullable',
            'biography' => 'string|max:255|nullable',
            'hobbies' => 'string|max:255|nullable'
        ];
    }

    /**
     * @return string
     */
    public function address(): string
    {
        return (string)$this->get('address', '');
    }

    /**
     * @return string
     */
    public function biography(): string
    {
        return (string)$this->get('biography', '');
    }

    /**
     * @return string
     */
    public function hobbies(): string
    {
        return (string)$this->get('hobbies', '');
    }
}
