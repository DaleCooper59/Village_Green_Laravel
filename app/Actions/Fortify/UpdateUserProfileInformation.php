<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:45'],
            'age' => ['required','integer', 'max:200'],
            'birth' => ['required', 'date', 'date_format:Y-m-d'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'tel' => ['required', 'string', 'max:50'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if (isset($input['username']) && $input['username'] != $user->username) {
            Validator::make($input, [
                'username' => ['required', 'string', 'max:255', 'unique:users'],
            ])->validateWithBag('updateProfileInformation');
        }

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'username' => $input['username'],
                'firstname' => $input['firstname'],
                'lastname' => $input['lastname'],
                'gender' => $input['gender'],
                'age' => $input['age'],
                'birth' => $input['birth'],
                'email' => $input['email'],
                'tel' => $input['tel'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'username' => $input['username'],
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'gender' => $input['gender'],
            'age' => $input['age'],
            'birth' => $input['birth'],
            'email' => $input['email'],
            'email_verified_at' => null,
            'tel' => $input['tel'],
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
