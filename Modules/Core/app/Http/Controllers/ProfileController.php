<?php

namespace Modules\Core\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Modules\Core\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('core::pages.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        
        if($request->validated()){
            $admin = auth()->user();

            // update profile photo
            if ($request->hasFile('profile_picture')) {

                $request->validate([
                    'profile_picture' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
                ]);        

                try {

                    $uploadedFile = $request->file('profile_picture');
                    $fileName = $admin->id . '_profile_' . $uploadedFile->getClientOriginalName();
                    $path = $uploadedFile->storeAs('profile', $fileName, 'public');

                    User::where('id', $admin->id)->update(['profile_picture' => $path]);

                    if(isset($admin->profile_picture) && Storage::disk('public')->exists($admin->profile_picture)){
                        Storage::disk('public')->delete($admin->profile_picture);
                    }

                    return back()->with('success', 'Profile Photo Updated Successfully');

                } catch (\Throwable $e) {

                    if (isset($admin->profile_picture) && Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                    return back()->with('error', 'Profile Photo Update Failed');
                }

            } // end profile photo update
        }

        $request->user()->update($request->validated());


        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('success', 'Profile Updated Successfully');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
