<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Thông tin chi tiết lịch làm thêm
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl mb-2 text-blue-500">Thông tin chung</h2>
                    <ul class="list-disc ml-6 mb-4">
                        <li><strong>Họ tên:</strong> {{ $overtime->name }}</li>
                        <li><strong>Phòng ban:</strong> {{ $overtime->department->name }}</li>
                        <li><strong>Thời gian bắt đầu:</strong> {{  date('d-m-Y H:i:s', strtotime($overtime->begin)) }}</li>
                        <li><strong>Thời gian kết thúc:</strong> {{ date('d-m-Y H:i:s', strtotime($overtime->end)) }}</li>
                        <li><strong>Mô tả công việc: </strong> {{ $overtime->description }}</li>
                        <li><strong>Trạng thái:</strong>
                            @if ($overtime->status == 'pending')
                            <span style='color: black'>chờ duyệt</span>
                            @elseif ($overtime->status == 'manager_approved')
                                <span style='color: #1d4ed8'>Quản lý đã duyệt</span>
                            @elseif ($overtime->status == 'bod_approved')
                            <span style='color: #047857'>Ban giám đốc đã duyệt</span>
                            @else
                            <span style='color: #ff4c00'>Đã từ chối</span>
                            @endif
                        </li>
                    </ul>
                    <hr class="mb-4">

                    @if ($overtime->manager_approved_at)
                        <h2 class="text-xl mb-2 text-blue-500">Thông tin quản lý duyệt</h2>
                        <ul class="list-disc ml-4 mb-4">
                            <li><strong>Họ tên:</strong> {{ $overtime->manager->name }}</li>
                            <li><strong>Duyệt lúc:</strong> {{ date('d-m-Y H:i:s', strtotime($overtime->manager_approved_at)) }}</li>
                            <li><strong>Ghi chú:</strong> {{ $overtime->manager_note }}</li>
                        </ul>
                        <hr class="mb-4">
                    @endif

                    @if ($overtime->bod_approved_at)
                        <h2 class="text-xl mb-2 text-blue-500">Thông tin ban giám đốc duyệt</h2>
                        <ul class="list-disc ml-4 mb-4">
                            <li><strong>Họ tên:</strong> {{ $overtime->bod->name }}</li>
                            <li><strong>Duyệt lúc:</strong> {{ date('d-m-Y H:i:s', strtotime($overtime->bod_approved_at)) }}</li>
                            <li><strong>Ghi chú:</strong> {{ $overtime->bod_note }}</li>
                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
