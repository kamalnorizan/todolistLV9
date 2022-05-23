<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\ActiveScope;
class Todolist extends Model
{
    use HasFactory;

    protected $table = 'todolists';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }

    /**
     * Get the user that owns the Todolist
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all of the tasks for the Todolist
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'todolist_id', 'id');
    }

    public function images()
    {
        return $this->morphMany(Gambar::class,'imageable');
    }
}
