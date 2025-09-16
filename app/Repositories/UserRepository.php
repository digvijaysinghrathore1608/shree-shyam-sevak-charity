<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use Exception;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class UserRepository
 */
class UserRepository extends BaseRepository
{
    public $fieldSearchable = [
        'first_name',
        'last_name',
        'email',
        'contact',
        'dob',
        'gender',
        'status',
        'password',

    ];

    /**
     * {@inheritDoc}
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * {@inheritDoc}
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @param  array  $userInput
     * @return bool
     */
    public function updateProfile($userInput)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();

            $user->update($userInput);

            if ((! empty($userInput['image']))) {
                $user->clearMediaCollection(User::PROFILE);
                $user->media()->delete();
                $user->addMedia($userInput['image'])->toMediaCollection(User::PROFILE);
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function store($input)
    {
        try {
            DB::beginTransaction();
            $input['password'] = Hash::make($input['password']);
            $staff = User::create($input);

            if (isset($input['role']) && ! empty($input['role'])) {
                $staff->assignRole($input['role']);
            }

            if (isset($input['profile']) && ! empty($input['profile'])) {
                $staff->addMedia($input['profile'])->toMediaCollection(User::PROFILE);
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $input
     * @param $id
     * @return bool
     */
    public function update($input, $id)
    {
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->update($input);
            if (isset($input['role']) && ! empty($input['role'])) {
                $user->syncRoles($input['role']);
            }

            if (isset($input['profile']) && ! empty($input['profile'])) {
                $user->clearMediaCollection(User::PROFILE);
                $user->media()->delete();
                $user->addMedia($input['profile'])->toMediaCollection(User::PROFILE);
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        $roles = Role::pluck('display_name', 'id');

        return $roles;
    }
}
