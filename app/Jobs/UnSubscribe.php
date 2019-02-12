<?php
declare(strict_types=1);

namespace App\Jobs;

use App\Http\Requests\UnSubscribeRequest;
use Henry\Domain\Subscriber\Repositories\SubscriberRepositoryInterface;
use Henry\Domain\Subscriber\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class UnSubscribe
 * @package App\Jobs
 */
class UnSubscribe implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Subscriber
     */
    private $subscriber;

    /**
     * Create a new job instance.
     * @param Subscriber $subscriber
     */
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * @param SubscriberRepositoryInterface $subscriberRepository
     * @return bool
     */
    public function handle(SubscriberRepositoryInterface $subscriberRepository): bool
    {
        return $subscriberRepository->update([
            'active' => 0
        ], $this->subscriber);
    }
}
