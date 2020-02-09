<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname' , 'email', 'password','img','phone','dob','city','state','zip','bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function friendsOfMine()
    {
        return $this->belongsToMany("App\User","friends","user_id","friend_id");
    }

    public function friendOf()
    {
        return $this->belongsToMany("App\User","friends","friend_id","user_id");
    }

    public function friends()
    {
        return $this->friendsOfMine()->wherePivot("accepted","accepted")->get()
            ->merge($this->friendOf()->where("accepted","accepted")->get());
    }

    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot("accepted", "pending")->get();
    }

    public function friendRequestsPending()
    {
        return $this->friendOf()->wherePivot("accepted", "pending")->get();
    }

    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where("id", $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequests()->where("id",$user->id)->count();
    }

    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }

    public function unfriend(User $user)
    {
        $this->friendOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where("id",$user->id)->first()
            ->pivot->update([
            "accepted"=>"accepted"
        ]);
    }

    public function isFriendsWith(User $user)
    {
        return (bool) $this->friends()->where("id",$user->id)->count();
    }

}
