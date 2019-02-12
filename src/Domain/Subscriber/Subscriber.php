<?php
declare(strict_types=1);

namespace Henry\Domain\Subscriber;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscriber
 * @package Henry\Domain\Subscriber
 */
class Subscriber extends Model
{
    protected $fillable = ['email'];
}
