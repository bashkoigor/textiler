<?php namespace Textiler\Main\Models;

use Model;

/**
 * Subscriber Model
 */
class Subscriber extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table associated with the model
     */
    public $table = 'textiler_main_subscribers';

    /**
     * @var array guarded attributes aren't mass assignable
     */
    protected $guarded = ['*'];

    /**
     * @var array fillable attributes are mass assignable
     */
    protected $fillable = [];

    /**
     * @var array rules for validation
     */
    public $rules = [
        'name' => 'required|max:16',
        'surname' => 'required|max:16',
        'email' => 'required|email',
        'country' => 'required|max:16',
        'city' => 'required|max:16',
        'street' => 'required|max:16',
        'zip_code' => 'required|max:16',
        'house' => 'required|numeric',
        'apartment' => 'numeric',
    ];

    /**
     * @var array translate for attribute
     */
    public $attributeNames = [
        'name'      => 'textiler.main::lang.validation.name',
        'surname'   => 'textiler.main::lang.validation.surname',
        'email'     => 'textiler.main::lang.validation.email',
        'country'   => 'textiler.main::lang.validation.country',
        'city'      => 'textiler.main::lang.validation.city',
        'street'    => 'textiler.main::lang.validation.street',
        'zip_code'  => 'textiler.main::lang.validation.zip_code',
        'house'     => 'textiler.main::lang.validation.house',
        'apartment' => 'textiler.main::lang.validation.apartment',
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array jsonable attribute names that are json encoded and decoded from the database
     */
    protected $jsonable = [];

    /**
     * @var array appends attributes to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array hidden attributes removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array dates attributes that should be mutated to dates
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array hasOne and other relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
