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
            SelectFilter::make('Trạng thái', 'status')
                ->options([
                    '' => 'Tất cả',
                    'pending' => 'Đang chờ',
                    'manager_approved' => 'Quản lý đã duyệt',
                    'bod_approved' => 'Giám đốc đã duyệt',
                    'denied' => 'Đã từ chối'
                ])->filter(function(Builder $builder, string $value) {

                    if ($value === 'pending') {
                        $builder->where('status', 'pending');
                    } elseif ($value === 'manager_approved') {
                        $builder->where('status', 'manager_approved');
                    } elseif ($value === 'bod_approved') {
                        $builder->where('status', 'bod_approved');
                    } elseif ($value === 'denied') {
                        $builder->where('status', 'denied');
                    }
                }),

            SelectFilter::make('Phòng ban', 'department_id')
                ->options(['' => 'Tất cả'] + Department::all()->pluck('name', 'id')->toArray())
                ->filter(function(Builder $builder, string $value) {
                    return $builder->where('department_id', $value);
                })
        ];
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),
            Column::make('Họ tên', 'name')->searchable(),
            Column::make('Phòng ban', 'department.name'),
            Column::make('Thời gian bắt đầu', 'begin'),
            Column::make('Thời gian kết thúc', 'end'),
            Column::make('Trạng thái', 'status')
                ->format(function($value, $row) {
                    if ($value == 'pending') {
                        return "<span style='color: black'>chờ duyệt</span>";
                    } elseif ($value == 'manager_approved') {
                        return "<span style='color: #1d4ed8'>Quản lý đã duyệt</span>";
                    } elseif ($value == 'bod_approved') {
                        return "<span style='color: #047857'>Ban giám đốc đã duyệt</span>";
                    } else {
                        return "<span style='color: #ff4c00'>Đã từ chối</span>";
                    }
                })->html(),
        ];
    }
}
