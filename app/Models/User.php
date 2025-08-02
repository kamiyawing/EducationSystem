<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'name_kana',
        'email',
        'password',
        'grade_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userGetList() {
        $id = Auth::id();
        $userData = User::where('id', $id)->first();
        return $userData;
    }

    public function updateProfile($id , $Request , $image_path) {
        User::where('id', $id)->update([
            'name' => $Request->input('name'),
            'name_kana' => $Request->input('name_kana'),
            'email' => $Request->input('email'),
            'profile_image' => $image_path, 
          ]);
    }

    public function userPassUpdate($id, $Request) {
        User::where('id', $id)->update([
            'password' => Hash::make($Request->input('new_password')),
        ]);
    }

    public function curriculumProgress()
    {
        return $this->hasMany(\App\Models\CurriculumProgress::class, 'user_id');
    }


    public function grade():BelongsTo 
    {
        return $this->belongsTo(Grade::class);
    }

   // public function completedDeliveries()
   // {
    //    return $this->belongsToMany(\App\Models\Delivery::class, 'completed_deliveries', 'user_id', 'delivery_id')
    //                ->withTimestamps();
   // }

}
