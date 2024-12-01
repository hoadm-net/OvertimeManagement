<div>
    <main class="mt-6">
        <div class="grid lg:grid-cols-1 px-8 pt-6 pb-8">

            <h2 class="text-xl text-blue-500 mb-4">Thông tin tăng ca</h2>
            <ul class="ml-6 mb-4 list-disc">
                <li><strong>Họ tên: </strong> {{ $overtime->name }}</li>
                <li><strong>Phòng ban: </strong> {{ $overtime->department->name }}</li>
                <li><strong>Bắt đầu: </strong> {{ date('d-m-Y H:i:s', strtotime($overtime->begin)) }}</li>
                <li><strong>Kết thúc: </strong> {{ date('d-m-Y H:i:s', strtotime($overtime->end)) }}</li>
                <li><strong>Mô tả công việc: </strong> {{ $overtime->description }}</li>
            </ul>

            @if ($overtime->status == 'manager_approved')
                <hr class="mb-4">
                <h2 class="text-xl text-blue-500 mb-4">Thông tin quản lý</h2>
                <ul class="ml-6 mb-4 list-disc">
                    <li><strong>Quản lý duyệt: </strong> {{ $overtime->manager->name }}</li>
                    <li><strong>Duyệt lúc: </strong> {{ date('d-m-Y H:i:s', strtotime($overtime->manager_approved_at)) }}</li>
                    <li><strong>Ghi chú: </strong> {{ $overtime->manager_note }}</li>
                </ul>
            @endif

            <hr class="mb-4">
            <h2 class="text-xl text-blue-500 mb-4">Duyệt đơn</h2>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="note">
                    Ghi chú
                </label>
                <textarea
                    wire:model="note"
                    name="note"
                    id="note" rows="3" class="block border-gray-300 shadow  w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                @error('note') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="flex space-x-4">
                <!-- Nút màu xanh -->
                <button
                    wire:click="approve()"
                    class="bg-blue-500 w-full text-white px-4 py-2 rounded hover:bg-blue-600">
                    Đồng ý
                </button>

                <!-- Nút màu đỏ -->
                <button
                    wire:click="deny()"
                    wire:confirm="Bạn có chắc muốn từ chối đơn này?"
                    class="bg-red-500 w-full text-white px-4 py-2 rounded hover:bg-red-600">
                    Không đồng ý
                </button>
            </div>

        </div>
    </main>
</div>
