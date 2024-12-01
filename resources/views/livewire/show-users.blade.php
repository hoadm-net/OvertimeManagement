<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse border border-gray-200 bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="px-6 py-3 border border-gray-300 text-left text-sm font-medium">ID</th>
                    <th class="px-6 py-3 border border-gray-300 text-left text-sm font-medium">Tên</th>
                    <th class="px-6 py-3 border border-gray-300 text-left text-sm font-medium">Email</th>
                    <th class="px-6 py-3 border border-gray-300 text-left text-sm font-medium">Trạng thái</th>
                    <th class="px-6 py-3 border border-gray-300 text-left text-sm font-medium">Vai trò</th>
                    <th class="px-6 py-3 border border-gray-300 text-left text-sm font-medium">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr class="hover:bg-gray-100">
                    <td class="px-6 py-3 border border-gray-300 text-sm">{{ $u->id }}</td>
                    <td class="px-6 py-3 border border-gray-300 text-sm">{{ $u->name }}</td>
                    <td class="px-6 py-3 border border-gray-300 text-sm">{{ $u->email }}</td>
                    <td class="px-6 py-3 border border-gray-300 text-sm">@if ($u->active) ✅ @else ❌ @endif</td>
                    <td class="px-6 py-3 border border-gray-300 text-sm">
                        @if ($u->role == 'su')
                            Quản trị viên
                        @elseif ($u->role == 'hr')
                            Nhân sự
                        @elseif ($u->role == 'manager')
                            Quản lý
                        @elseif ($u->role == 'bod')
                            Ban giám đốc
                        @endif
                    </td>
                    <td class="px-6 py-3 border border-gray-300 text-sm">
                        @if ($u->active)
                            <button class="text-red-600 hover:underline ml-2" wire:click="lock({{ $u }})">Khóa</button>
                        @else
                            <button class="text-green-600 hover:underline ml-2" wire:click="unlock({{ $u }})">Mở</button>
                        @endif
                         |
                        <button
                            wire:click="$dispatch('openModal', { component: 'edit-user', arguments: { user: {{ $u->id }} }})"
                            class="text-blue-600 hover:underline">Cập nhật</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
