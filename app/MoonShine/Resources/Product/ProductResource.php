<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Product;

use App\Models\Product;
use App\MoonShine\Resources\Category\CategoryResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * Раздел админки «Изделия».
 * На странице изделия есть форма обратной связи.
 */
class ProductResource extends ModelResource
{
    protected string $model = Product::class;

    protected string $title = 'Изделия';

    //protected string $column = 'name';

    protected array $with = ['category'];

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название', 'title'),
            BelongsTo::make('Категория', 'category', 'name', CategoryResource::class)->nullable(),
            Number::make('Цена', 'price')->sortable(),
            Number::make('Сортировка', 'sort')->sortable(),
            Switcher::make('Опубликовано', 'is_published'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make('Основное', [
                ID::make(),
                Text::make('Название', 'title')->required(),
                Text::make('Ссылка (slug)', 'slug')
                    ->hint('Латиницей. Если оставить пустым — заполнится автоматически.'),
                Textarea::make('Описание', 'description')
                    ->hint('Можно использовать HTML-теги')
                    ->customAttributes(['rows' => 15]),
                BelongsTo::make('Категория', 'category', 'name', CategoryResource::class)->nullable(),
                Number::make('Цена, ₽', 'price')->step(0.01),
                Number::make('Сортировка', 'sort')->default(100),
                Switcher::make('Опубликовано', 'is_published')->default(true),
            ]),

            Box::make('SEO и фото', [
                Text::make('Meta title', 'meta_title'),
                Textarea::make('Meta description', 'meta_description'),
                Image::make('Фото изделия', 'og_image')->dir('products')->removable(),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return $this->formFields();
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'sort' => ['nullable', 'integer'],
        ];
    }

    protected function search(): array
    {
        return ['id', 'title', 'slug'];
    }
}
