<?php
declare(strict_types=1);

namespace App\Mail;

use Henry\Domain\Subscriber\Subscriber as ModelSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class Subscriber
 * @package App\Mail
 */
class Subscriber extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var ModelSubscriber
     */
    public $subscriber;

    /**
     * Create a new message instance.
     * @param ModelSubscriber $subscriber
     */
    public function __construct(ModelSubscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->view('emails.subscriber');
    }
}
