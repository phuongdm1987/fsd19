<?php
declare(strict_types=1);

namespace App\Jobs\User;

use App\Http\Requests\User\UpdateProfileRequest;
use Henry\Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class UpdateProfile
 * @package App\Jobs\User
 */
class UpdateProfile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $attributes;

    /**
     * Create a new job instance.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @param UpdateProfileRequest $request
     * @return self
     */
    public static function fromRequest(
        UpdateProfileRequest $request
    ): self {
        return new static([
            'address' => $request->address(),
            'biography' => $request->biography(),
            'hobbies' => $request->hobbies(),
        ]);
    }

    /**
     * Execute the job.
     * @param UserRepositoryInterface $userRepository
     * @return void
     */
    public function handle(UserRepositoryInterface $userRepository): void
    {
        $userRepository->update($this->attributes, auth()->user());
    }
}
