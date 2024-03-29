<?php
declare(strict_types=1);

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StorePostRequest
 * @package App\Http\Requests\Post
 */
class StorePostRequest extends FormRequest
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
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required|string|max:255|unique:posts,title',
            'content' => 'required|string',
            'author' => 'required|string|max:150',
            'post_active' => 'required|boolean',
            'post_tags' => 'string|nullable|max:255',
            'addition_links' => 'string|nullable|max:255',
            'link' => 'url|nullable|max:255',
            'date-timer' => 'date|date_format:Y-m-d H:i'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return (string)$this->get('title','');
    }

    /**
     * @return string
     */
    public function content(): string
    {
        return (string)$this->get('content','');
    }

    /**
     * @return string
     */
    public function author(): string
    {
        return (string)$this->get('author', '');
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
        return (string)$this->get('post_tags','');
    }

    /**
     * @return string
     */
    public function relatedPosts(): string
    {
        return (string)$this->get('addition_links','');
    }

    /**
     * @return string
     */
    public function link(): string
    {
        return (string)$this->get('link','');
    }

    /**
     * @return string
     */
    public function scheduleDate(): string
    {
        return (string)$this->get('date-timer', '');
    }
}
