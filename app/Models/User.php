<?php

namespace App\Models;

use App\Models\Pivot\AnimeUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'email',
        'password',
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

    public function animes()
    {
        return $this->belongsToMany(Anime::class)
            ->using(AnimeUser::class)
            ->withPivot('status')
            ->withTimestamps();
    }

    public function addFriend(User $friend)
    {
        $this->friendsOfMain()->syncWithoutDetaching($friend,[
            'accepted'  => false
        ]);
    }

    // Friends Acceptations

    public function acceptFriend(User $friend)
    {
        $friend->FriendsOfMain()->updateExistingPivot($this->id,[
            'accepted' => true
        ]);
    }

    // Pending (Adding) Friends

    public function pendingFriendsOfMain()
    {
        return  $this->FriendsOfMain()->wherePivot('accepted',false);
    }
    // accept friends relation
    public function acceptFriendsOfMain()
    {
        return  $this->FriendsOfMain()->wherePivot('accepted',true);
    }

    // Friends requests
    public function pendingFriendsOf()
    {
        return  $this->FriendsOf()->wherePivot('accepted',false);
    }



    public function FriendsOfMain()
    {
        return $this->belongsToMany(User::class,'friends','user_id','friend_id')
            ->withPivot('accepted');
    }

    public function FriendsOf()
    {
        return $this->belongsToMany(User::class,'friends','friend_id','user_id')
            ->withPivot('accepted');
    }


}
