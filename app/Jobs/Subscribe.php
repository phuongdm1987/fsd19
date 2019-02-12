<?php
declare(strict_types=1);

namespace App\Jobs;

use App\Http\Requests\SubscribeRequest;
use Henry\Domain\Subscriber\Repositories\SubscriberRepositoryInterface;
use Henry\Domain\Subscriber\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

/**
 * Class Subscribe
 * @package App\Jobs
 */
class Subscribe implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    private $email;

    /**
     * Create a new job instance.
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * @param SubscribeRequest $request
     * @return self
     */
    public static function fromRequest(SubscribeRequest $request): self
    {
        return new static(
            $request->email()
        );
    }

    /**
     * @param SubscriberRepositoryInterface $subscriberRepository
     * @return Subscriber
     */
    public function handle(SubscriberRepositoryInterface $subscriberRepository): Subscriber
    {
        $subscriber = $subscriberRepository->create([
            'email' => $this->email
        ]);

        Mail::to($this->email)->queue(new \App\Mail\Subscriber($subscriber));

        return $subscriber;
    }
}
