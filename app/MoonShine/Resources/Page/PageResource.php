<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Page;

use App\Models\Page;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * Раздел админки «Текстовые страницы».
 * Здесь лежит политика обработки персональных данных (slug: privacy)
 * и любые другие простые страницы.
 */
class PageResource extends ModelResource
{
    protected string $model = Page::class;

    protected string $title = 'Страницы';

    protected string $column = 'title';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Заголовок', 'title'),
            Text::make('Ссылка', 'slug'),
            Switcher::make('Опубликована', 'is_published'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Заголовок', 'title')->required(),
                Text::make('Ссылка (slug)', 'slug')
                    ->required()
                    ->hint('Например privacy — страница будет доступна по адресу /page/privacy'),
                TinyMce::make('Текст страницы', 'content')
                    ->locale('ru')
                    ->hint('Можно форматировать текст, делать отступы и вставлять картинки'),
                Text::make('Meta title', 'meta_title'),
                Textarea::make('Meta description', 'meta_description'),
                Switcher::make('Опубликована', 'is_published')->default(true),
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
            'slug' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
        ];
    }

    protected function search(): array
    {
        return ['id', 'title', 'slug'];
    }
}
