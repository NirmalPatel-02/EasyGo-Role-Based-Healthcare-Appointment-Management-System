<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'title',
        'text',
        'slug',
        'show_tips',
        'show_nav',
        'published',
    ];

    /**
     * Get the published status as a boolean.
     *
     * @return bool
     */
    public function isPublished()
    {
        return $this->published === 'Published';
    }

    /**
     * Scope to filter only published pages.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('published', 'Published');
    }

    /**
     * Scope to filter pages shown in navigation.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeShowInNav($query)
    {
        return $query->where('show_nav', 1);
    }

    /**
     * Scope to filter pages shown in tips.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeShowInTips($query)
    {
        return $query->where('show_tips', 1);
    }
}
