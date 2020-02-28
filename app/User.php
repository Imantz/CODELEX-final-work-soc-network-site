<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'surname' , 'email', 'password','img','phone','dob','city','state','zip','bio', 'slug'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messagesSent()
    {
        return $this->hasMany(Message::class, "sender_id");
    }

    public function messagesReceived()
    {
        return $this->hasMany(Message::class, "receiver_id");
    }

    public function allMessages()
    {
        return collect([$this->messagesSent,$this->messagesReceived])->collapse();
    }



    public function followers()
    {
        return $this->belongsToMany(Follower::class)->withTimestamps();
    }

    public function followingTo()
    {
        return $this->hasMany(Follower::class, "user_id");
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function wallFeeds()
    {
        return $this->hasMany(WallFeed::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

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

    public function friendRequestCount()
    {
        return $this->friendRequests()->count();
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

    public function isFollowing(User $user): bool
    {
        return DB::table('follower_user')->where("user_id",Auth::user()->id)->where("follower_id",$user->id)->count();
    }
}
