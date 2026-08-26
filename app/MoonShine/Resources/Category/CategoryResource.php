<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Category;

use App\Models\Category;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * Раздел админки «Категории».
 * Категории используются и для статей, и для изделий.
 */
class CategoryResource extends ModelResource
{
    protected string $model = Category::class;

    protected string $title = 'Категории';

    protected string $column = 'name';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название', 'name'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'name')->required(),
            Textarea::make('Описание', 'description'),
        ];
    }

    protected function detailFields(): iterable
    {
        return $this->formFields();
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }

    protected function search(): array
    {
        return ['id', 'name'];
    }
}
