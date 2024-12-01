<div class="grid lg:grid-cols-1">
    <form
        wire:submit="submit"
        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
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
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                {{ __('Department') }}
            </label>
            <select
                wire:model="department"
                id="department"
                name="department"
                class="border-gray-300 shadow col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-700 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                <option>---------------</option>
                @foreach($departments as $dep)
                    <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                @endforeach
            </select>
            @error('department') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="begin">
                {{ __('Begin') }}
            </label>
            <input
                class="hw-dt border-gray-300 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="begin"
                type="text"
                wire:model="begin"
            >
            @error('begin') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="end">
                {{ __('End') }}
            </label>
            <input
                class="hw-dt border-gray-300 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="text"
                id="end"
                wire:model="end"
            >
            @error('end') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                {{ __('Job Description') }}
            </label>
            <textarea
                wire:model="description"
                name="description"
                id="description" rows="3" class="block border-gray-300 shadow  w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <button
                class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                {{ __("Submit") }}
            </button>
        </div>
    </form>
</div>
