<?php


namespace App\Http\Filters;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    public const TITLE = 'title';
    public const SLUG = 'slug';
    public const PRICE = 'price';
    public const LENGHT = 'lenght';
    public const WIDTH = 'width';
    public const WEIGHT = 'weight';
    public const CATEGORY_ID = 'category_id';


    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::SLUG => [$this, 'slug'],
            self::PRICE => [$this, 'price'],
            self::LENGHT => [$this, 'lenght'],
            self::WIDTH => [$this, 'width'],
            self::WEIGHT => [$this, 'weight'],
            self::CATEGORY_ID => [$this, 'categoryId'],
        ];
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like',  "%{$value}%" );
    }

    public function slug(Builder $builder, $value)
    {
        $builder->where('slug', $value);
    }

    public function price(Builder $builder, $value)
    {
        $builder->where('price', $value);
    }

    public function lenght(Builder $builder, $value)
    {
        $builder->where('lenght', $value);
    }

    public function width(Builder $builder, $value)
    {
        $builder->where('width', $value);
    }

    public function weight(Builder $builder, $value)
    {
        $builder->where('weight', $value);
    }

    public function categoryId(Builder $builder, $value)
    {
        $builder->where('category_id', $value);
    }
}
