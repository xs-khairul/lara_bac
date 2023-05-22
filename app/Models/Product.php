<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CrudTrait;
    use HasFactory;


    protected $fillable = ['product', 'description', 'qnt', 'price'];



    public function setDescriptionAttribute($value)
    {
        $attribute_name = "description";
        $disk = "public";
        $destination_path = "folder_1/subfolder_1";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path, $fileName = null);
        // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }


    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj) {
            \Storage::disk('public')->delete($obj->description);
        });
    }

}
