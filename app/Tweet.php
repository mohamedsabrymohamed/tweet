<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = [
        'tweet_text', 'tweet_text_ar', 'user_id',
    ];

    protected $hidden = [
        'tweet_text_ar',
    ];

    public function getTweetTextAttribute($value)
    {
        $current_locale = App::getLocale();
        if ($current_locale == 'ar') {
            return $this->tweet_text_ar;
        }
        return $value;
    }
}
