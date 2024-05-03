<?php

namespace App\Domain\Book\Entities;

use App\Domain\Store\Entities\Store;
use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $primaryKey = 'isbn';

    protected $fillable = ['name', 'value'];

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function setIsbn(int $isbn): void
    {
        $this->attributes['isbn'] = $isbn;
    }

    public function setValue(float $value): void
    {
        $this->attributes['value'] = $value;
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class);
    }
    protected static function newFactory()
    {
        return BookFactory::new();
    }
}
