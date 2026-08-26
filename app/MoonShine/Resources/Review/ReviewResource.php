<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Review;

use App\Models\Review;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Url;

class ReviewResource extends ModelResource
{
    protected string $model = Review::class;

    protected string $title = 'Отзывы';

    protected string $column = 'name_author';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Автор', 'name_author'),
            Text::make('Оценка', 'rating'),
            Text::make('Источник', 'source'),
            Switcher::make('Опубликован', 'is_published'),
            Date::make('Дата', 'published_at')->format('d.m.Y')->sortable(),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Имя автора', 'name_author')->required(),
                Select::make('Оценка', 'rating')->options([
                    5 => '5 — отлично',
                    4 => '4 — хорошо',
                    3 => '3 — нормально',
                    2 => '2 — плохо',
                    1 => '1 — очень плохо',
                ])->default(5),
                Textarea::make('Текст отзыва', 'text')
                    ->required()
                    ->customAttributes(['rows' => 8]),
                Select::make('Источник', 'source')->options([
                    '2ГИС' => '2ГИС',
                    'Яндекс' => 'Яндекс Карты',
                    'ВКонтакте' => 'ВКонтакте',
                    'Сайт' => 'Оставлен на сайте',
                ])->nullable(),
                Url::make('Ссылка на источник', 'source_url')
                    ->hint('Полная ссылка на отзыв, например https://2gis.ru/...'),
                Date::make('Дата отзыва', 'published_at'),
                Switcher::make('Опубликован', 'is_published')->default(true),
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
            'name_author' => ['required', 'string', 'max:255'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'text' => ['required', 'string'],
            'source_url' => ['nullable', 'url', 'max:255'],
        ];
    }

    protected function search(): array
    {
        return ['id', 'name_author', 'text'];
    }
}
