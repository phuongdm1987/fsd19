<?php
declare(strict_types=1);

namespace App\Jobs\User;

use App\Http\Requests\User\ChangePasswordRequest;
use Henry\Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Hash;

/**
 * Class ChangePassword
 * @package App\Jobs\User
 */
class ChangePassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    private $oldPassword;
    /**
     * @var string
     */
    private $newPassword;

    /**
     * Create a new job instance.
     * @param string $oldPassword
     * @param string $newPassword
     */
    public function __construct(string $oldPassword, string $newPassword)
    {
        $this->oldPassword = $oldPassword;
        $this->newPassword = $newPassword;
    }

    /**
     * @param ChangePasswordRequest $request
     * @return self
     */
    public static function fromRequest(
        ChangePasswordRequest $request
    ): self {
        return new static(
            $request->oldPassword(),
            $request->newPassword()
        );
    }

    /**
     * Execute the job.
     * @param UserRepositoryInterface $userRepository
     * @return bool
     */
    public function handle(UserRepositoryInterface $userRepository): ?bool
    {
        if (!Hash::check($this->oldPassword, auth()->user()->password)) {
            return false;
        }

        return $userRepository->update(['password' => Hash::make($this->newPassword)], auth()->user());
    }
}
