<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Attribute\PersonAttribute;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Metable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Storage;

class Person extends Model
{
    use PersonAttribute,
        Eloquence,
        Metable,
        SoftDeletes,
        CascadeSoftDeletes,
        HasSlug;

    /**
     * Get the options for generating the slug.
     */

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name ')
            ->saveSlugsTo('slug');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ["name", "description"];

    public $timestamps = ["create_at", "update_at"];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $cascadeDeletes = ['jobsCascade'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'persons';

    /**
     * Get the key name for route model binding.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    // ***********************************************************
    // ***********************************************************
    // ************************ RELATIONS ************************
    // ***********************************************************
    // ***********************************************************

    /**
     * Get all the jobs for the Person.
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'person_jobs');
    }

    // ***********************************************************
    // ***********************************************************
    // ************************CASCADE  RELATIONS ****************
    // ***********************************************************
    // ***********************************************************

    /**
     * Cascade Deletes for person_jobs relation
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */

    public function jobsCascade()
    {
        return $this->hasMany(PersonJob::class, "person_id", "id");
    }
}
