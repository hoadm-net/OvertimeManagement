<div>

    <div class="mb-4 border-b-2 my-2">
        <h3 class="text-lg font-semibold mb-2">Danh sách quản trị viên</h3>
        <button
            wire:click="$dispatch('openModal', { component: 'add-manager', arguments: { department: {{ $department }} }})"
            class="mb-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:ring focus:ring-blue-300 transition duration-200">
            Thêm quản trị viên</button>

        <ul class="list-disc ml-8 mt-4">
            @foreach($department->users as $u)
                <li>{{ $u->name }} - <button
                        class="mb-4 bg-red-500 text-white px-2 py-1 rounded-lg hover:bg-red-600 focus:ring focus:ring-red-300 transition duration-200"
                        wire:click="removeUser({{ $u->id }})"
                        wire:confirm="Bạn có muốn xóa quản trị viên này không?"
                    >Xóa</button></li>
            @endforeach
        </ul>
    </div>

    <form
        wire:submit="submit">

        <h3 class="text-lg font-semibold mb-4">Thông tin phòng ban</h3>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Phòng Ban
            </label>
            <input
                wire:model="name"
                class="border-gray-300 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="name"
                type="text"
            />

            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Mô tả
            </label>
            <textarea
                wire:model="description"
                id="description"
                rows="3"
                class="block border-gray-300 shadow  w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <button class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                {{ __("Save") }}
            </button>
        </div>
    </form>

</div>
