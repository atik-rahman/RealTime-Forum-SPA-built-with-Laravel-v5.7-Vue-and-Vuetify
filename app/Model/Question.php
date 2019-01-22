<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\User;
use App\Model\Reply;
use App\Model\Category;

class Question extends Model
{
    protected $fillable = ['title','slug','body','category_id','user_id'];

    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'datetime:r'
    ];

    protected $appends = ['path'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function getPathAttribute(){
        return asset("api/question/$this->slug");
    }


}
