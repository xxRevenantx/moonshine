<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Group;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

use MoonShine\Support\Enums\SortDirection;
use MoonShine\UI\Fields\Text;

use MoonShine\Laravel\Fields\Relationships\BelongsTo;

/**
 * @extends ModelResource<Group>
 */
class GroupResource extends ModelResource
{
    protected string $model = Group::class;

    protected string $title = 'Grupos';

    protected bool $createInModal = false;

    protected bool $editInModal = true;

    protected bool $detailInModal = false;

    protected bool $columnSelection = true;

    protected int $itemsPerPage = 10;

    protected bool $errorsAbove = true;

    protected bool $isPrecognitive = true; 

    protected ?string $alias = 'grupos';


    protected SortDirection $sortDirection = SortDirection::ASC;

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Grupos', 'group'),

            BelongsTo::make('Grado perteneciente', 'grade', 
            fn($item) => "$item->grade",
            resource: GradeResource::class)->sortable(),
          

        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
            ])
        ];
    }

 
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
        ];
    }


   
    protected function rules(mixed $item): array
    {
        return [];
    }
}
