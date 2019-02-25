<?php
declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\WebController;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Jobs\User\ChangePassword;
use App\Jobs\User\UpdateProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Account
 */
class ProfileController extends WebController
{
    /**
     * @return View
     */
    public function profile(): View
    {
        $user = auth()->user();
        return view('account.profiles.index', compact('user'));
    }

    /**
     * @param UpdateProfileRequest $request
     * @return RedirectResponse
     */
    public function updateProfile(UpdateProfileRequest $request): RedirectResponse
    {
        $this->dispatchNow(UpdateProfile::fromRequest($request));
        return redirect()->route('account.show')->with('success', 'Thông tin tài khoản đã được cập nhật.');
    }

    /**
     * @param ChangePasswordRequest $request
     * @return RedirectResponse
     */
    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $result = $this->dispatchNow(ChangePassword::fromRequest($request));

        if (!$result) {
            return redirect()->back()->withErrors(['old_password' => 'Mật khẩu hiện tại không chính xác.']);
        }

        return redirect()->route('account.show')->with('success', 'Mật khẩu của bạn đã được cập nhật');
    }
}
