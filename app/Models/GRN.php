<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GRN extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function grn_items()
    {
        return $this->hasMany(GRNItem::class, 'grn_id', 'id');
    }
}
