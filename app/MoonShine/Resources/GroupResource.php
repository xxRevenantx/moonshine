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
use MoonShine\ImportExport\ExportHandler;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\UI\Fields\Text;

use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Handlers\Handler;

use MoonShine\ImportExport\Contracts\HasImportExportContract;
use MoonShine\ImportExport\Traits\ImportExportConcern;

/**
 * @extends ModelResource<Group>
 */
class GroupResource extends ModelResource implements HasImportExportContract
{
    use ImportExportConcern;

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

    protected bool $isLazy = true;

    protected string $sortColumn = 'grade_id';
    protected SortDirection $sortDirection = SortDirection::ASC;




    public function getRedirectAfterSave(): string
    {
        return 'admin/resource/grupos/index-page';
    }


    public function getTitle(): string
    {
        return "Grupos";
    }



    protected function export(): ? Handler
    {
        return ExportHandler::make(__('moonshine::ui.export'))
            ->filename(sprintf('Niveles_%s', date('Ymd-His'))) // Nombre y fecha del archivo



        ;
    }

    protected function exportFields(): iterable // Campos  que se exportarán
    {
        return [

            Text::make('Grupos', 'group'),
            BelongsTo::make('Grado perteneciente', 'grade',
            fn($item) => "$item->grade",
            resource: GradeResource::class),

        ];
    }


    protected function indexFields(): iterable
    {
        return [

            Text::make('Grupos', 'group')->sortable(),

            BelongsTo::make('Grado perteneciente', 'grade',
            fn($item) => "$item->grade",
            resource: GradeResource::class)->sortable(),

            BelongsTo::make('Nivel perteneciente', 'level',
            fn($item) => "$item->level",
            resource: LevelResource::class)->sortable(),

            BelongsTo::make('Generacion perteneciente', 'generation',
            fn($item) => "$item->start_year - $item->end_year",
            resource: GenerationResource::class)->sortable(),



        ];
    }


    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Grupos', 'group')->placeholder('Nombre del grupo')->hint("A, B, C, D..."),
                BelongsTo::make('Grado perteneciente', 'grade',
                fn($item) => "$item->grade",
                resource: GradeResource::class),

            ])
        ];
    }


    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Grupos', 'group'),
            BelongsTo::make('Grado perteneciente', 'grade',
            fn($item) => "$item->grade",
            resource: GradeResource::class),
        ];
    }

    protected function filters(): iterable // Campos que se mostrarán en los filtros
    {
        return [
            Text::make('Grupos', 'group')->placeholder('Nombre del grupo'),
            BelongsTo::make('Grado perteneciente', 'grade',
            fn($item) => "$item->grade",
            resource: GradeResource::class)->nullable(),
        ];
    }



    protected function rules(mixed $item): array
    {
        return [
            'group' => ['required', 'string', 'max:1'],
            'grade_id' => ['required', 'integer'],
        ];
    }

    public function prepareForValidation(): void
    {
        request()?->merge([
            'group' => request()
                ?->string('group')
                ->upper()
                ->value()

        ]);
    }


}
