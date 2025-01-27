<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Laravel\Components\Layout\{Locales, Notifications, Profile, Search};
use MoonShine\UI\Components\{Breadcrumbs,
    Components,
    Layout\Flash,
    Layout\Div,
    Layout\Body,
    Layout\Burger,
    Layout\Content,
    Layout\Footer,
    Layout\Head,
    Layout\Favicon,
    Layout\Assets,
    Layout\Meta,
    Layout\Header,
    Layout\Html,
    Layout\Layout,
    Layout\Logo,
    Layout\Menu,
    Layout\Sidebar,
    Layout\ThemeSwitcher,
    Layout\TopBar,
    Layout\Wrapper,
    When};
use App\MoonShine\Resources\PostResource;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\LevelResource;
use App\MoonShine\Resources\DirectorResource;
use App\MoonShine\Resources\SupervisorResource;
use MoonShine\MenuManager\MenuDivider;
use MoonShine\MenuManager\MenuGroup;
use App\MoonShine\Resources\GroupResource;
use App\MoonShine\Resources\GradeResource;

final class MoonShineLayout extends AppLayout
{
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
            // MenuItem::make('Posts', PostResource::class),
            MenuItem::make('Niveles', LevelResource::class)->icon('academic-cap'),
            MenuItem::make('Groups', GroupResource::class)->icon('user-group'),
            MenuItem::make('Grades', GradeResource::class)->icon('square-3-stack-3d'),
            MenuDivider::make(),
            MenuGroup::make('Autoridades')->icon('identification')->setItems([
                MenuItem::make('Directores', DirectorResource::class)->icon('users'),
                MenuItem::make('Supervisores', SupervisorResource::class)->icon('users'),
            ]),

        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);


    }

    public function build(): Layout
    {
        return parent::build();
    }
}
