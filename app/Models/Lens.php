<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lens extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function material(){
        return $this->belongsTo(LensMaterial::class, 'material_id', 'id');
    }

    public function coating(){
        return $this->belongsTo(LensCoating::class, 'coating_id', 'id');
    }

    public function type(){
        return $this->belongsTo(LensType::class, 'type_id', 'id');
    }

    public function location(){
        return $this->belongsTo(Branch::class, 'location_id', 'id');
    }

    public function power(){
        return "[".$this->eye .' | '. $this->sph.' | '. $this->cyl.' | '. $this->axis.' | '. $this->add."]";
    }
}
