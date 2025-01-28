<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Generation;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\ImportExport\ExportHandler;
use MoonShine\Laravel\Handlers\Handler;
use MoonShine\Support\AlpineJs;
use MoonShine\Support\Enums\JsEvent;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

class GenerationResource extends ModelResource
{
    protected string $model = Generation::class;

    protected string $title = 'Generaciones';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = false;

    protected bool $columnSelection = true;

    protected int $itemsPerPage = 10;

    protected bool $errorsAbove = true;

    protected bool $isPrecognitive = true;

    protected ?string $alias = 'generaciones';



    protected bool $isLazy = true;

    protected SortDirection $sortDirection = SortDirection::ASC;

    

    public function modifyListComponent(ComponentContract $component): ComponentContract
{
    return parent::modifyListComponent($component)->customAttributes([
        'data-my-attr' => 'value'
    ]);
}


    public function getRedirectAfterSave(): string
    {
        return 'admin/resource/generaciones/index-page';
    }


    public function getTitle(): string
    {
        return "Generaciones";
    }



    protected function export(): ? Handler
    {
        return ExportHandler::make(__('moonshine::ui.export'))
            ->filename(sprintf('Generaciones_%s', date('Ymd-His'))) // Nombre y fecha del archivo

        ;
    }

    protected function exportFields(): iterable // Campos  que se exportarán
    {
        return [
            ID::make(),
            Number::make('start_year', 'Año de incio'),
            Number::make('end_year', 'Año de término'),
            Switcher::make('Status', 'status')
            ->onValue('active')
            ->offValue('inactive')
            ->sortable()
        ];
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Number::make('Año de Inicio', 'start_year')->sortable(),
            Number::make('Año de Término', 'end_year')->sortable(),

            Switcher::make('Status', 'status')
                ->onValue('active')
                ->withUpdateRow($this->getListComponentName())


        ];
    }

  
    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Number::make('Año de Inicio', 'start_year')->placeholder('Año de inicio'),
                Number::make('Año de Término', 'end_year')->placeholder('Año de término'),
                Switcher::make('Estado de la generación', 'status')
                ->default('active')
                ->onValue('active')
                ,

            ])
        ];
    }


    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Number::make('Año de Inicio', 'start_year'),
            Number::make('Año de Término', 'end_year'),
           Switcher::make('Status', 'status')
            ->onValue('active')
            ->sortable()




        ];
    }


    protected function rules(mixed $item): array
    {
        return [
            // 'start_year' => ['required', 'integer', 'unique:generations,start_year,' . $item->id],
            // 'end_year' => ['required', 'integer', 'unique:generations,end_year,' . $item->id],

            'start_year' => ['required', 'integer'],
            'end_year' => ['required', 'integer'],


        ];
    }
}
