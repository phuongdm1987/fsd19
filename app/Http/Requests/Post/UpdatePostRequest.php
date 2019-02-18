<?php
declare(strict_types=1);

namespace App\Http\Requests\Post;

use Henry\Domain\Post\Post;
use Henry\Domain\User\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePostRequest
 * @package App\Http\Requests\Post
 */
class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function authorize(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:posts,title',
            'content' => 'required|string',
            'post_active' => 'required|boolean',
            'post_tags' => 'string',
            'category_id' => '|required|int|exist:categories,id',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->get('title','');
    }

    /**
     * @return string
     */
    public function content(): string
    {
        return $this->get('content','');
    }

    /**
     * @return int
     */
    public function active(): int
    {
        return (int)$this->get('post_active',0);
    }

    /**
     * @return int
     */
    public function categoryId(): int
    {
        return (int)$this->get('category_id', 0);
    }

    /**
     * @return string
     */
    public function tags(): string
    {
        return $this->get('post_tags','');
    }
}
