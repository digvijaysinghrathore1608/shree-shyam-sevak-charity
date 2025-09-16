<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateChangePasswordRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Country;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class UserController extends AppBaseController
{
    /**
     * @var UserRepository
     */
    public $userRepo;

    /**
     * UserController constructor.
     *
     * @param  UserRepository  $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function editProfile()
    {
        $user = Auth::user();

        return view('profile.index', compact('user'));
    }

    /**
     * @return Application|Factory|View
     */
    public function userEditProfile()
    {
        $user = Auth::user();

        return view('user.profile.index', compact('user'));
    }

    /**
     * @param  UpdateUserProfileRequest  $request
     * @return Application
     */
    public function updateProfile(UpdateUserProfileRequest $request)
    {
        $this->userRepo->updateProfile($request->all());
        Flash::success('User profile updated successfully.');

        if (getLogInUser()->role_name == 'Admin') {
            return redirect(route('profile.setting'));
        }

        return redirect(route('user.profile.setting'));
    }

    /**
     * @param  UpdateChangePasswordRequest  $request
     * @return JsonResponse
     */
    public function changePassword(UpdateChangePasswordRequest $request)
    {
        $input = $request->all();

        try {
            /** @var User $user */
            $user = Auth::user();
            if (! Hash::check($input['current_password'], $user->password)) {
                return $this->sendError('Current password is invalid.');
            }
            $input['password'] = Hash::make($input['new_password']);
            $user->update($input);

            return $this->sendSuccess('Password updated successfully.');
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $countries = Country::all()->pluck('country_name', 'id');
        $roles = $this->userRepo->getRole();

        return view('admin.users.create', compact('countries', 'roles'));
    }

    /**
     * @param  Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        $this->userRepo->store($input);

        Flash::success('User created successfully.');

        return redirect(route('users.index'));
    }

    /**
     * @param  User  $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        $countries = Country::all()->pluck('country_name', 'id');
        $roles = $this->userRepo->getRole();

        return view('admin.users.edit', compact('user', 'countries', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        $this->userRepo->update($input, $user->id);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * @param  User  $user
     * @return mixed
     */
    public function destroy(User $user)
    {
        if ($user->is_default) {
            return $this->sendError('Super Admin Can\'t be Deleted');
        }
        $user->delete();

        return $this->sendSuccess('User deleted successfully.');
    }

    /**
     * @param  User  $user
     * @return mixed
     */
    public function EmailVerify(User $user)
    {
        $user = User::findOrFail($user->id);
        $emailVerified = $user->email_verified_at == null ? Carbon::now() : null;
        $user->update(['email_verified_at' => $emailVerified]);

        return $this->sendSuccess('Email verified successfully.');
    }

    /**
     * @param  User  $user
     * @return mixed
     */
    public function activeDeactiveStatus(User $user)
    {
        $user = User::findOrFail($user->id);
        $is_active = $user->is_active == 0 ? 1 : 0;
        $user->update(['is_active' => $is_active]);

        return $this->sendSuccess('Status updated successfully.');
    }

    /**
     * @param  User  $user
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function changeLanguage(Request $request)
    {
        $language = $request->get('languageName');

        $user = getLogInUser();
        $user->update(['language' => $language]);

        return $this->sendSuccess('Language updated successfully.');
    }
}
