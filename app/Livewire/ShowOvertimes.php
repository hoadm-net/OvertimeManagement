<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Overtime;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
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
                    'urgent' => 'Urgent',
                    'manager_approved' => 'The manager has approved',
                    'bod_approved' => 'The director has approved',
                    'denied' => 'Has been declined',
                ])->filter(function(Builder $builder, string $value) {

                    if ($value === 'pending') {
                        $builder->where('status', 'pending');
                    } elseif ($value === 'manager_approved') {
                        $builder->where('status', 'manager_approved');
                    } elseif ($value === 'bod_approved') {
                        $builder->where('status', 'bod_approved');
                    } elseif ($value === 'denied') {
                        $builder->where('status', 'denied');
                    } elseif ($value === 'urgent') {
                        $builder->where('status', 'urgent');
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
                    if ($value == 'pending') {
                        return "<span style='color: black'>Pending</span>";
                    } elseif ($value == 'urgent') {
                        return "<span style='color: #ff4c00'>Urgent</span>";
                    } elseif ($value == 'manager_approved') {
                        return "<span style='color: #1d4ed8'>The manager has approved</span>";
                    } elseif ($value == 'bod_approved') {
                        return "<span style='color: #047857'>The director has approved</span>";
                    } else {
                        return "<span style='color: #888888; text-decoration: line-through'>Has been declined</span>";
                    }
                })->html(),
        ];
    }
}
