<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        return view('user-profile', compact(['user']));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $rules = [
            'first_name' => ['required'],
            'last_name' => ['required'],
        ];
        if (!empty($request->get('photo'))) $rules['photo'] = ['image', 'mimes:jpg,jpeg,png', 'file|size:5120'];
        $this->validate($request, $rules);

        $data = $request->only(['first_name', 'last_name', 'address',]);


        if ($photo = $request->file('photo')) {
            $prefix = $request->user()->id;
            $path = UserProfile::IMAGE_DIR . "/{$prefix}.webp";
            $originalImage = Image::make($photo)->encode('webp', 90);
            Storage::disk('public')->put($path, $originalImage);

            $data['photo'] = $path;
        }

        $data['updated_by'] = $request->user()->id;

        $user->profile()->update($data);
        $user->update([
            'name' => $data['first_name'],
        ]);

        return response()->json([
            'code' => 200,
            'results' => [
                'user' => $user,
                'redirect' => '',
            ],
            'message' => 'Profile updated',
        ], 200);
    }
}
