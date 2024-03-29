<?php
declare(strict_types=1);

namespace Henry\Domain\Category;

use Henry\Domain\Post\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Category
 * @package Henry\Domain\Category
 */
class Category extends Model
{
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return route('categories.show', [$this->id, str_slug($this->getName(), '-', 'vi')]);
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parents');
    }

    /**
     * @return BelongsTo
     */
    public function relationParent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parents');
    }
}
