<!-- Modal body -->

<input type="hidden" name="lane_id" value="{{ $lane_id ?? '' }}" />
<input type="hidden" name="id" value="{{ old('id', $task->id ?? '') }}" />
<div class="grid gap-4 mb-4 grid-cols-2">
    <div>
        <div class="col-span-2">
            <label
                for="title"
                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white"
                >Title</label
            >
            <input
                type="text"
                name="title"
                value="{{ old('title', $task->title ?? '') }}"
                id="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Add title here"
                required=""
            />
        </div>
        <div class="col-span-2 mt-4">
            <label
                for="file"
                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white"
            >
                File @if(!empty($task->attachment_path)) :
                <a
                    href="{{ route('task.attachment', $task) }}"
                    class="italic underline decoration-sky-500 decoration-wavy text-gray-900 dark:text-white"
                >
                    {{ $task->attachment_name ?? 'Download' }}
                </a>
                @endif
            </label>
            <input
                name="attachment_path"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="file_input"
                type="file"
            />
        </div>

        <div class="col-span-2 mt-4">
            <label
                for="description"
                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white"
                >Description</label
            >
            <textarea
                id="description"
                name="description"
                rows="8"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Write your description here..."
            >
              {{ old('description', $task->description ?? '') }}</textarea
            >
        </div>
    </div>
    <div>
        @php $raw = old('assignee_ids', $task?->assignee_ids ?? []);
        $assignedIds = array_map('intval', is_array($raw) ? $raw : (array)
        json_decode($raw ?: '[]', true)); $priority = old('priority',
        $task?->priority); @endphp
        <div class="col-span-2 sm:col-span-1">
            <label
                for="category"
                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white"
                >Members</label
            >
            <select
                id="user_ids[]"
                multiple
                name="user_ids[]"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            >
                @foreach ($users as $user)
                <option value="{{ $user->id }}" {{(in_array($user->
                    id, $assignedIds) ? 'selected=selected' : '') }}>{{
                    $user->name }} ({{ $user->email }})
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-span-2 sm:col-span-1 mt-4">
            <label
                for="price"
                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white"
                >Priority</label
            >

            <ul
                class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            >
                <li
                    class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                >
                    <div class="flex items-center ps-3">
                        <input id="horizontal-list-radio-license" type="radio"
                        {{( $priority == "high") ? 'checked' : ''}} value="high"
                        name="priority" class="w-4 h-4 text-blue-600 bg-gray-100
                        border-gray-300 focus:ring-blue-500
                        dark:focus:ring-blue-600 dark:ring-offset-gray-700
                        dark:focus:ring-offset-gray-700 focus:ring-2
                        dark:bg-gray-600 dark:border-gray-500">
                        <label
                            for="horizontal-list-radio-license"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                            >High</label
                        >
                    </div>
                </li>
                <li
                    class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                >
                    <div class="flex items-center ps-3">
                        <input id="horizontal-list-radio-id" type="radio" {{(
                        $priority == "medium") ? 'checked' : ''}} value="medium"
                        name="priority" class="w-4 h-4 text-blue-600 bg-gray-100
                        border-gray-300 focus:ring-blue-500
                        dark:focus:ring-blue-600 dark:ring-offset-gray-700
                        dark:focus:ring-offset-gray-700 focus:ring-2
                        dark:bg-gray-600 dark:border-gray-500">
                        <label
                            for="horizontal-list-radio-id"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                            >Medium</label
                        >
                    </div>
                </li>
                <li
                    class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                >
                    <div class="flex items-center ps-3">
                        <input id="horizontal-list-radio-military" type="radio"
                        {{( $priority == "low") ? 'checked' : ''}} value="low"
                        name="priority" class="w-4 h-4 text-blue-600 bg-gray-100
                        border-gray-300 focus:ring-blue-500
                        dark:focus:ring-blue-600 dark:ring-offset-gray-700
                        dark:focus:ring-offset-gray-700 focus:ring-2
                        dark:bg-gray-600 dark:border-gray-500">
                        <label
                            for="horizontal-list-radio-military"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                            >Low</label
                        >
                    </div>
                </li>
                <li class="w-full dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="horizontal-list-radio-passport" type="radio"
                        {{( $priority == "lowest") ? 'checked' : ''}}
                        value="lowest" name="priority" class="w-4 h-4
                        text-blue-600 bg-gray-100 border-gray-300
                        focus:ring-blue-500 dark:focus:ring-blue-600
                        dark:ring-offset-gray-700
                        dark:focus:ring-offset-gray-700 focus:ring-2
                        dark:bg-gray-600 dark:border-gray-500">
                        <label
                            for="horizontal-list-radio-passport"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                            >Lowest</label
                        >
                    </div>
                </li>
            </ul>
        </div>
        <div class="grid gap-4 mb-4 grid-cols-4">
            <div class="col-span-2 sm:col-span-2 mt-4">
                <label
                    for="category"
                    class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white"
                    >Start date</label
                >

                <div class="relative max-w-sm">
                    <input
                        name="start_date"
                        type="date"
                        value="{{ old('start_date', $task?->start_date?->format('Y-m-d')) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date"
                    />
                </div>
            </div>
            <div class="col-span-2 sm:col-span-2 mt-4">
                <label
                    for="category"
                    class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white"
                    >Start date</label
                >

                <div class="relative max-w-sm">
                    <input
                        name="end_date"
                        value="{{ old('end_date', $task?->end_date?->format('Y-m-d')) }}"
                        type="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date"
                    />
                </div>
            </div>
        </div>
    </div>
</div>
