<?php
declare(strict_types=1);

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AddRecommendRequest
 * @package App\Http\Requests\Post
 */
class AddRecommendRequest extends FormRequest
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
            'post_id' => 'required|integer|exists:posts,id'
        ];
    }

    /**
     * @return int
     */
    public function postId(): int
    {
        return (int)$this->get('post_id', 0);
    }
}
