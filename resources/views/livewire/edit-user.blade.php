<div>
    <form
        wire:submit="submit">

        <div class="mb-4">

            <ul>
                <li><strong>Họ tên</strong>: {{ $user->name }}</li>
                <li><strong>Email</strong>: {{ $user->email }}</li>
            </ul>

        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="active">
                Trạng thái kích hoạt
            </label>

            <input
                wire:model="active"
                class="border-green-300 shadow appearance-none border rounded py-2 px-3 text-green-700 leading-tight focus:outline-none focus:shadow-outline"
                id="active"
                type="checkbox"
                placeholder="{{ __("Active") }}"
            />

            @error('active') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                {{ __('Role') }}
            </label>
            <select
                id="role"
                name="role"
                wire:model="role"
                class="border-gray-300 shadow col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-700 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                <option>-------------------</option>
                <option value="su" >Quản trị viên</option>
                <option value="hr" >Nhân viên HCNS</option>
                <option value="manager">Quản lý</option>
                <option value="bod" >Ban giám đốc</option>
            </select>
            @error('role') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                {{ __('Password') }}
            </label>
            <input
                wire:model="password"
                class="border-gray-300 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="password"
                type="password"
                placeholder="{{ __("Password") }}"
            />

            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                {{ __('Confirm Password') }}
            </label>
            <input
                wire:model="password_confirmation"
                class="border-gray-300 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="password_confirmation"
                type="password"
                placeholder="{{ __("Confirm Password") }}"
            />

            @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <button class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                {{ __("Save") }}
            </button>
        </div>
    </form>

</div>
