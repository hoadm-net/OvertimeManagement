<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Overtime;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ShowOvertimes extends DataTableComponent
{
    protected $model = Overtime::class;
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('view-overtime', ['id' => $row]);
            });
        $this->setDefaultSort('id', 'desc');
        $this->setLayout('livewire.show-overtimes');
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Status', 'status')
                ->options([
                    '' => 'All',
                    'pending' => 'Pending',
                    'processing' => 'Processing',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                ])->filter(function(Builder $builder, string $value) {
                    if ($value === 'pending') {
                        $builder->where('status', 'pending');
                    } elseif ($value === 'processing') {
                        $builder->where('status', 'processing');
                    } elseif ($value === 'approved') {
                        $builder->where('status', 'approved');
                    } elseif ($value === 'rejected') {
                        $builder->where('status', 'rejected');
                    }
                }),

            SelectFilter::make('Department', 'department_id')
                ->options(['' => 'All'] + Department::all()->pluck('name', 'id')->toArray())
                ->filter(function(Builder $builder, string $value) {
                    return $builder->where('department_id', $value);
                })
        ];
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),
            Column::make('Full Name', 'name')->searchable(),
            Column::make('Department', 'department.name'),
            Column::make('Start Time', 'begin'),
            Column::make('End Time', 'end'),
            Column::make('Status', 'status')
                ->format(function($value, $row) {
                    return "<span class='capitalize'>".$value."</span>";
                })->html(),
        ];
    }
}
