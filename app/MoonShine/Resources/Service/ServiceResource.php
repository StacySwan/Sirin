<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Service;

use App\Models\Service;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * Раздел админки «Услуги».
 * На каждой странице услуги есть кнопка «Заказать» с формой заявки.
 */
class ServiceResource extends ModelResource
{
    protected string $model = Service::class;

    protected string $title = 'Услуги';

    protected string $column = 'name';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название', 'name'),
            Text::make('Ссылка', 'slug'),
            Number::make('Сортировка', 'sort')->sortable(),
            Switcher::make('Опубликована', 'is_published'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make('Основное', [
                ID::make(),
                Text::make('Название', 'name')->required(),
                Text::make('Ссылка (slug)', 'slug')
                    ->hint('Латиницей. Если оставить пустым — заполнится автоматически.'),
                Textarea::make('Описание услуги', 'content')
                    ->hint('Можно использовать HTML-теги')
                    ->customAttributes(['rows' => 15]),
                Number::make('Сортировка', 'sort')
                    ->default(100)
                    ->hint('Чем меньше число, тем выше в списке'),
                Switcher::make('Опубликована', 'is_published')->default(true),
            ]),

            Box::make('SEO', [
                Text::make('Meta title', 'meta_title'),
                Textarea::make('Meta description', 'meta_description'),
                Image::make('Картинка Open Graph', 'og_image')->dir('services')->removable(),
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
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'sort' => ['nullable', 'integer'],
        ];
    }

    protected function search(): array
    {
        return ['id', 'name', 'slug'];
    }
}
