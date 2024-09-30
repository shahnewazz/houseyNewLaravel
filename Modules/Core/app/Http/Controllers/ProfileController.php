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
    public function update(ProfileUpdateRequest $request)
    {

        $user = User::findOrFail($request->user()->id);

        if($user->hasRole('super_admin') && $request->status == 'inactive'){
            return redirect()->route('profile.edit')->with('error', 'Super Admin Account Cannot Be Deactivated');
        }


        // update profile photo
        if ($request->hasFile('profile_picture')) {

            $request->validate([
                'profile_picture' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            ]);        

            try {

                $uploadedFile = $request->file('profile_picture');
                $fileName = $user->id . '_profile_' . $uploadedFile->getClientOriginalName();
                $path = $uploadedFile->storeAs('profile', $fileName, 'public');
                
                if(isset($user->profile_picture) && Storage::disk('public')->exists($user->profile_picture)){
                    Storage::disk('public')->delete($user->profile_picture);
                }


                $user->profile_picture = $path;

            } catch (\Throwable $e) {

                if (isset($user->profile_picture) && Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
                return back()->with('error', 'Profile Photo Add Failed');
            }

        } // end profile photo update

        
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->email      = $request->email;
        $user->phone      = $request->phone;
        $user->status     = $request->status;
        $user->address    = $request->address;
        $user->city       = $request->city;
        $user->state      = $request->state;
        $user->zip_code   = $request->zip_code;
        $user->country    = $request->country;
             

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile Updated Successfully');
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
