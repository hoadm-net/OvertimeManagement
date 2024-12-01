<?php

namespace App\Exports;

use App\Models\Overtime;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class OvertimeExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public $begin;
    public $end;
    public $status;
    public $department;

    public function __construct($begin, $end, $status, $department)
    {
        $this->begin = $begin;
        $this->end = $end;
        $this->status = $status;
        $this->department = $department;
    }
    public function query()
    {
        $query = Overtime::query();

        if ($this->begin) {
            $query->whereDate('begin', '>=', $this->begin);
        }

        if ($this->end) {
            $query->whereDate('end', '<=', $this->end);
        }

        if ($this->department) {
            $query->where('department_id', $this->department);
        }

        if ($this->status != '') {
            $query->where('status', $this->status);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            '#',
            'Họ tên',
            'Ngày bắt đầu',
            'Ngày kết thúc',
            'Trạng thái',
        ];
    }

    public function get_status($status) {
        if ($status == 'pending') {
            return 'Đang chờ';
        } elseif ($status == 'manager_approved') {
            return 'Quản lý đã duyệt';
        } elseif ($status == 'bod_approved') {
            return 'Giám đốc đã duyệt';
        } elseif ($status == 'denied') {
            return 'Đã từ chối';
        }
    }
    public function map($ot): array
    {
        return [
            $ot->id,
            $ot->name,
            Carbon::createFromFormat('Y-m-d H:i:s', $ot->begin)->format('d-m-Y H:i'),
            Carbon::createFromFormat('Y-m-d H:i:s', $ot->end)->format('d-m-Y H:i'),
            $this->get_status($ot->status),
        ];
    }
}
