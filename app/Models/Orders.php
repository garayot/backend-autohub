<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    public function Units()
    {
        return $this->belongsTo(Units::class, 'car_ID');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'customer_ID');
    }

    /**
     * The table associated with the model.
     * x
     * @var string  
     */
    protected $table = 'orders';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'order_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_ID',
        'car_ID',
        'date',
        'status',

    ];
}
