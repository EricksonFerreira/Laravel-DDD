<?php

namespace App\Domain\Store\Entities;

use App\Domain\Book\Entities\Book;
use Database\Factories\StoreFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'active'];

    public function setName(string $name): void
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('Name is required');
        }

        $this->attributes['name'] = $name;
    }

    public function setAddress(string $address): void
    {
        if (empty($address)) {
            throw new \InvalidArgumentException('Address is required');
        }

        $this->attributes['address'] = $address;
    }

    public function setActive(bool $active): void
    {
        $this->attributes['active'] = $active;
    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    protected static function newFactory()
    {
        return StoreFactory::new();
    }

}
