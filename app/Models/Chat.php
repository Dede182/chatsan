<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    use HasFactory;

    public function sender($id){
        // $sender =  User::where('id',$id)->first();
        return Auth::user()->id === $id;
    }

    public function getAvatar($id){
        $user =  User::where('id',$id)->first();

        $firstCharacter = $user->email[0];


        if(is_numeric($firstCharacter)){
            $integerToUse = ord(strtolower($firstCharacter)) -21;
        }else{
            $integerToUse = ord(strtolower($firstCharacter)) -96;

        }

        return "https://www.gravatar.com/avatar/"
                .md5($user->email)
                .'?s=200'
                .'&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-'
                .$integerToUse
                .'.png'
        ;
    }
}
