<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\MoonShine\Resources\Review\ReviewResource;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\Palettes\PurplePalette;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\ColorManager\PaletteContract;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\BlogPost\BlogPostResource;
use App\MoonShine\Resources\Category\CategoryResource;
use App\MoonShine\Resources\Page\PageResource;
use App\MoonShine\Resources\Product\ProductResource;
use App\MoonShine\Resources\Service\ServiceResource;

final class MoonShineLayout extends AppLayout
{
    /**
     * @var null|class-string<PaletteContract>
     */
    protected ?string $palette = PurplePalette::class;

    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function menu(): array
    {
        return [
            ...parent::menu(),
            MenuItem::make(ReviewResource::class, 'Отзывы', 'star'),
            MenuItem::make(BlogPostResource::class, 'Статьи', ),
            MenuItem::make(CategoryResource::class, 'Категории',),

            MenuItem::make(PageResource::class, 'Страницы',),
            MenuItem::make(ProductResource::class, 'Изделия',),
            MenuItem::make(ServiceResource::class, 'Услуги',),
        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }

}
