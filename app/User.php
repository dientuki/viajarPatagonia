<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    /**
     * Set the user's password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

   static function getAll() {
      $request = request();
      $queries = [];

      $users = User::select('id', 'name', 'email');

      if ($request->has('order')) {
        $users->orderBy('id', $request->get('order'));
        $queries['order'] = $request->get('order');
      } else {
        $users->orderBy('id', 'desc');
        $queries['order'] = 'desc';
      }  

      return $users->simplePaginate(20)->appends($queries);     
   } 

   static function getEdit($id){

    $result = User::select('id', 'name', 'email')
        ->where('id', $id)
        ->get()->first();

    if (is_array($id)) {
      if (count($result) == count(array_unique($id))) {
        return $result;
      }
    } elseif (! is_null($result)) {
      return $result;
    }

    //Laravel 4 fallback
    return abort(404);
  }   
  
}
