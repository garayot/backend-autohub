<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    use HasFactory;
    public function Orders()
    {
        return $this->hasMany(Orders::class, 'car_ID');
    }
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'units';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'car_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'make',
        'model_name',
        'model_year',
        'type',
        'color',
        'price',
        'description',
        'image1',
        'image2',
        'image3'
    ];
}
