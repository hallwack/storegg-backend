<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UserProfile extends Model
{
    use HasFactory;
    const IMAGE_DIR = 'user-profiles/';
    protected $guarded = ['id'];


    public function getProfilePictureAttribute()
    {
        $configData = Helper::applClasses();
        $blank_image = $configData['theme'] === 'dark' ? asset('images/svg/blank-image-dark.svg') : asset('images/svg/blank-image.svg');
        $path = $this::IMAGE_DIR . "/{$this->user_id}.webp";
        if (Storage::disk('public')->exists($path)) {
            return asset(Storage::url($path));
        }

        return $blank_image;
    }

    public function getPhotoExistAttribute()
    {
        $path = $this::IMAGE_DIR . "/{$this->user_id}.webp";
        if (Storage::disk('public')->exists($path)) {
            return Storage::url($path);
        }

        return false;
    }
}
