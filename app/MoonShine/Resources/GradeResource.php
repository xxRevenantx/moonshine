<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Grade;
use Closure;
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\ImportExport\ExportHandler;
use MoonShine\ImportExport\Traits\ImportExportConcern;
use MoonShine\Support\Enums\SortDirection;

use MoonShine\UI\Fields\Text;

use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Handlers\Handler;
use MoonShine\UI\Fields\Number;
use MoonShine\ImportExport\Contracts\HasImportExportContract;
use MoonShine\Support\DTOs\Select\Option;
use MoonShine\Support\DTOs\Select\Options;
use MoonShine\Support\Enums\ClickAction;
use MoonShine\Support\Enums\Color;
use MoonShine\UI\Components\Badge;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Switcher;

/**
 * @extends ModelResource<Grade>
 */
class GradeResource extends ModelResource implements HasImportExportContract
{
    use ImportExportConcern;

    protected string $model = Grade::class;

    protected string $title = 'Grados';

    protected bool $createInModal = false;

    protected bool $editInModal = true;

    protected bool $detailInModal = false;

    protected bool $columnSelection = true;

    protected int $itemsPerPage = 10;

    protected bool $errorsAbove = true;

    protected bool $isPrecognitive = true;

    protected ?string $alias = 'grados';

    protected bool $isLazy = true;

    protected SortDirection $sortDirection = SortDirection::ASC;


    protected ?ClickAction $clickAction = ClickAction::SELECT;



    // protected function modifyQueryBuilder(Builder $builder): Builder // Filtro para mostrar solo los registros activos en la tabla
    // {
    //     return $builder->whereHas('generation', function ($query) {
    //         $query->where('status', 'active');
    //     });
    // }

    protected function resolveOrder(string $column, string $direction, ?Closure $callback): static
    {
        if ($callback instanceof Closure) {
            $callback($this->newQuery(), "level_id", "ASC");
        } else {
            $this->newQuery()->orderBy("level_id", "ASC");
        }
 
        return $this;
    }




    public function getRedirectAfterSave(): string
    {
        return 'admin/resource/grados/index-page';
    }

    public function getTitle(): string
    {
        return "Grados";
    }

    protected function export(): ? Handler
    {
        return ExportHandler::make(__('moonshine::ui.export'))
            ->filename(sprintf('Grados_%s', date('Ymd-His'))) // Nombre y fecha del archivo


        ;
    }

    protected function exportFields(): iterable // Campos  que se exportarán
    {
        return [
            ID::make(),
            Text::make('Grado', 'grade'),
            Text::make('Número de Grado', 'grade_number'),
            BelongsTo::make('Nivel perteneciente', 'level',
            fn($item) => "$item->level",
            resource: LevelResource::class),
            BelongsTo::make('Año de inicio', 'generation',
            fn($item) => "$item->start_year",
            resource: GenerationResource::class),
            BelongsTo::make('Año de Término', 'generation',
            fn($item) => "$item->end_year",
            resource: GenerationResource::class),
            
            BelongsTo::make('Status', 'generation',
            fn($item) => $item->status == 'active' ? Badge::make($item->status, Color::SUCCESS) : Badge::make('inactivo', Color::ERROR),
            resource: GenerationResource::class),



        ];
    }


    protected function indexFields(): iterable
    {
        return [

            Text::make('Grado', 'grade'),
            Number::make('Número de Grado', 'grade_number'),
            BelongsTo::make('Nivel perteneciente', 'level',
            fn($item) => "$item->level",
            resource: LevelResource::class)->sortable(),
           
            BelongsTo::make('Año de inicio', 'generation',
            fn($item) => "$item->start_year",
            resource: GenerationResource::class)->sortable(),

            BelongsTo::make('Año de Término', 'generation',
            fn($item) => "$item->end_year ",
            resource: GenerationResource::class)->sortable(),


            BelongsTo::make('Status', 'generation',
            fn($item) => $item->status == 'active' ? Badge::make($item->status, Color::SUCCESS) : Badge::make('inactivo', Color::ERROR),
            resource: GenerationResource::class)->sortable(),

        ];


     
    }


    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Grado', 'grade')->hint("Ingrese el grado en letra")->placeholder('Ingrese el grado'),
                Number::make('Numero de Grado', 'grade_number')->hint('Ingrese el número de grado')
                ->min(1)
                ->max(10)
                ->step(1)
                ->default(1)
                ->buttons()->placeholder('Ingrese el número de grado'),
                BelongsTo::make('Nivel perteneciente', 'level',
                fn($item) => "$item->level",
                resource: LevelResource::class),

                BelongsTo::make('Generacion perteneciente', 'generation',
                fn($item) => "$item->start_year - $item->end_year ",
                resource: GenerationResource::class),
           

                ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Grado', 'grade'),
            Text::make('Número de Grado', 'grade_number'),

           


        ];
    }

    protected function filters(): iterable // Campos que se mostrarán en los filtros
    {
        return [
            Text::make('Grado', 'grade')->placeholder("Buscar por grado"),
            Text::make('Número de Grado', 'grade_number')->placeholder("Buscar por número de grado"),
            BelongsTo::make('Nivel perteneciente', 'level',
            fn($item) => "$item->level",
            resource: LevelResource::class)->nullable(),

            BelongsTo::make('Año de inicio', 'generation',
            fn($item) => "$item->start_year",
            resource: GenerationResource::class)->nullable(),


            BelongsTo::make('Año de Término', 'generation',
            fn($item) => "$item->end_year",
            resource: GenerationResource::class)->nullable(),

            
        ];
    }



    protected function search(): array // Campos que se mostrarán en la búsqueda
    {
        return [
            'grade',
            'grade_number',
            'level.level',
            'generation.start_year',
            'generation.end_year',
            'generation.status'




        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'grade' => ['required', 'string', 'max:10'],
            'grade_number' => ['required', 'integer', 'min:1', 'max:10'],
            'level_id' => ['required', 'integer'],
        ];
    }
}
