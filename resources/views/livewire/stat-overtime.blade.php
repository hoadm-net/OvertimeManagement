<div>
    <div class="mb-6">
{{--        Nav--}}
        <div class="max-w mx-auto bg-white p-6 rounded">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <label for="begin" class="block text-sm font-medium text-gray-700">Bắt đầu</label>
                    <input
                        wire:model.live="begin"
                        type="date"
                        id="begin"
                        name="begin"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="end" class="block text-sm font-medium text-gray-700">Kết thúc</label>
                    <input
                        wire:model.live="end"
                        type="date" id="end" name="end" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Trạng thái</label>
                    <select
                        wire:model.live="status"
                        id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Tất cả</option>
                        <option value="pending">Đang chờ</option>
                        <option value="manager_approved">Quản lý đã duyệt</option>
                        <option value="bod_approved">Giám đốc đã duyệt</option>
                        <option value="denied">Đã từ chối</option>
                    </select>
                </div>
                <div>
                    <label for="department" class="block text-sm font-medium text-gray-700">Phòng ban</label>
                    <select
                        wire:model.live="department"
                        id="department" name="department" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Tất cả</option>
                        @foreach($departments as $dep)
                            <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex space-x-4">
                    <button
                        class="bg-gray-500 w-full text-white px-4 py-2 rounded hover:bg-gray-600"
                        wire:click="clear()"
                    >Xóa bộ lọc</button>
                    <button
                        class="bg-blue-500 w-full text-white px-4 py-2 rounded hover:bg-blue-600"
                        wire:click="export()"
                    >Xuất dữ liệu</button>
                </div>
            </div>
        </div>
    </div>
    <div>
{{--        Content--}}
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse bg-white ">
                <thead>
                <tr>
                    <th class="px-6 py-4 text-left font-bold text-black border-b">#</th>
                    <th class="px-6 py-4 text-left font-bold text-black border-b">Họ và tên</th>
                    <th class="px-6 py-4 text-left font-bold text-black border-b">Ngày bắt đầu</th>
                    <th class="px-6 py-4 text-left font-bold text-black border-b">Ngày kết thúc</th>
                    <th class="px-6 py-4 text-left font-bold text-black border-b">Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                @foreach($overtimes as $ot)
                <tr class="odd:bg-gray-100 even:bg-white hover:bg-gray-200">
                    <td class="px-6 py-4 border-b">{{ $ot->id }}</td>
                    <td class="px-6 py-4 border-b">{{ $ot->name }} ({{ $ot->department->name }})</td>
                    <td class="px-6 py-4 border-b">{{ date('d-m-Y H:i', strtotime($ot->begin)) }}</td>
                    <td class="px-6 py-4 border-b">{{ date('d-m-Y H:i', strtotime($ot->end)) }}</td>
                    <td class="px-6 py-4 border-b">
                        @if ($ot->status == 'pending')
                            <span style='color: black'>chờ duyệt</span>
                        @elseif ($ot->status == 'manager_approved')
                            <span style='color: #1d4ed8'>Quản lý đã duyệt</span>
                        @elseif ($ot->status == 'bod_approved')
                            <span style='color: #047857'>Ban giám đốc đã duyệt</span>
                        @else
                            <span style='color: #ff4c00'>Đã từ chối</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-6">
                {{ $overtimes->links() }}
            </div>
        </div>
    </div>
</div>
