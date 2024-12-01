<div>
    <main class="mt-6">
        <div class="grid lg:grid-cols-1">
            <form
                wire:submit="submit"
                class="bg-white shadow-md rounded px-8 pt-6 pb-8">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mail">
                        {{ __('Email') }}
                    </label>
                    <input
                        wire:model="mail"
                        class="border-gray-300 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="mail"
                        type="email"
                        placeholder="{{ __('Email') }}">

                    @error('mail') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fullname">
                        {{ __('Fullname') }}
                    </label>
                    <input
                        wire:model="name"
                        class="border-gray-300 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="fullname"
                        type="text"
                        placeholder="{{ __('Fullname') }}">
                    @error('name') <span class="error">{{ $message }}</span> @enderror
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
                        <option value="su">Quản trị viên</option>
                        <option value="hr">Nhân viên HCNS</option>
                        <option value="manager">Quản lý</option>
                        <option value="bod">Ban giám đốc</option>
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
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm_password">
                        {{ __('Confirm Password') }}
                    </label>
                    <input
                        wire:model="password_confirmation"
                        class="border-gray-300 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="confirm_password"
                        type="password"
                        placeholder="{{ __("Confirm Password") }}"
                    />
                </div>

                <div class="flex items-center justify-between">
                    <button class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        {{ __("Submit") }}
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
