<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $table = 'service_categories';
    protected $fillable = ['name', 'slug', 'image','featured'];
    public function services(){
        return $this->hasMany(Service::class);
    }
}
