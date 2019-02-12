<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Http\Requests\UnSubscribeRequest;
use App\Jobs\Subscribe;
use App\Jobs\UnSubscribe;
use Henry\Domain\Subscriber\Subscriber;
use Illuminate\Http\RedirectResponse;

/**
 * Class SubscriberController
 * @package App\Http\Controllers
 */
class SubscriberController extends Controller
{
    /**
     * @param SubscribeRequest $request
     * @return RedirectResponse
     */
    public function subscribe(SubscribeRequest $request): RedirectResponse
    {
        $this->dispatchNow(Subscribe::fromRequest($request));

        return redirect()->back()->with('success', 'Bạn đã đăng ký subscriber thành công!');
    }

    /**
     * @param Subscriber $subscriber
     * @return RedirectResponse
     */
    public function unSubscribe(Subscriber $subscriber): RedirectResponse
    {
        UnSubscribe::dispatchNow($subscriber);

        return redirect()->route('home')->with('success', 'Bạn đã hủy đăng ký subscriber thành công!');
    }
}
