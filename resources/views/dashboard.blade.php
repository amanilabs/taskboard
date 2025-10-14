@extends('layouts.app') @section('content') <div class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <x-navbar />
    <main class="p-4 h-auto pt-20"> @if ($errors->any()) <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">{{ $errors }}</span>
            </div>
        </div> @endif <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 mb-3 mt-6"> @foreach($board->lanes as $lane) <div data-lane-id="{{ $lane->id }}">
                <div class="flex justify-between items-center pb-3 mb-3 rounded-t sm:mb-4 dark:border-gray-600 border-b">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $lane->name }}</h3>
                    <span class="text-s font-medium px-2.5 py-0.5 rounded bg-purple-100 text-purple-800 dark:bg-purple-200 dark:text-purple-800">{{ $lane->tasks->count() }}</span>
                </div> @foreach($lane->tasks as $task) @php $left = $task->days_left;  $over = $task->overdue_by;  $url = $task->attachment_path ? Storage::disk('public')->url($task->attachment_path) : null; // "/storage/attachments/abc123.png" 
                $mime = $task->attachment_path ? Storage::disk('public')->mimeType($task->attachment_path) : null; 
                $isImage = $mime && str_starts_with($mime, 'image/'); @endphp <div class="mb-4 md:mb-4 max-w-fill p-3 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700" data-task-id="{{ $task->id }}">
                    <div class="flex items-center justify-between pb-2">
                        <a href="#">
                            <h5 class="mb-2 text-l font-bold tracking-tight text-gray-900 dark:text-white">{{ $task->title }}</h5>
                        </a>
                        <button id="dropdownButton{{ $task->id }}" data-dropdown-toggle="dropdown{{ $task->id }}" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                            <span class="sr-only">Open dropdown</span>
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdown{{ $task->id }}" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                            <ul class="py-2" aria-labelledby="dropdownButton{{ $task->id }}">
                                <li>
                                    <a data-action="{{ route('task.store') }}" data-lane-id="{{ $lane->id }}" data-url="{{ route('task.form', (['task'=>$task, 'lane_id' => $lane->id]) ) }}" class="open-task-form block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"> Edit </a>
                                </li>
                                <li>
                                    <a class="open-task-delete block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" data-action="{{ route('task.destroy', $task->id) }}" data-task-id="{{ $task->id }}" data-modal-target="deleteTaskModal" data-modal-toggle="deleteTaskModal">Delete</a>
                                </li>
                            </ul>
                        </div>
                    </div> 
                    @if($task->attachment_path) 
                    @if($isImage) 
                    <a data-tooltip-target="tooltip-default{{ $task->id }}">
                        <img class="rounded-lg" src="{{$url}}" alt="" />
                    </a>
                    <div id="tooltip-default{{ $task->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                        {{ $task->attachment_name }}
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div> @else <a href="{{ route('task.attachment', $task) }}" class="text-white bg-[#2557D6] hover:bg-[#2557D6]/90 focus:ring-4 focus:ring-[#2557D6]/50 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#2557D6]/50 me-2 mb-2">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd" />
                        </svg> {{ $task->attachment_name }}
                    </a> @endif @endif @if($task->description) <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $task->description }}</p> @endif <div class="flex items-center justify-between"> @php $assignedIds = array_map('intval', is_array($task->assignee_ids) ? $task->assignee_ids : (array) json_decode($task->assignee_ids ?: '[]', true)); @endphp <div class="flex -space-x-4 rtl:space-x-reverse"> @foreach ($assignedIds as $user_id) <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                <span class="font-medium text-gray-600 dark:text-gray-300"> {{ get_initials(\App\Models\User::whereKey($user_id)->value('name')) }}</span>
                            </div> @endforeach </div> @if($lane->id !=3) @if($over > 0) <span class="bg-red-100 text-red-800 text-sm font-medium inline-flex items-center me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">
                            <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                            </svg>{{ $over }} days overdue</span> @else <span class="bg-red-100 text-red-800 text-sm font-medium inline-flex items-center me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">
                            <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                            </svg>{{ $left }} days left</span> @endif @else <span class="bg-green-100 text-green-800 text-sm font-medium inline-flex items-center me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">
                            <svg class="w-6 h-6 text-gray-800 dark:text-green-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                            </svg> Done</span> @endif </div>
                    <dl> @if($task->assigned_to) <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">{{ $task->assigned_to }}</dt> @endif </dl>
                </div> @endforeach <button data-action="{{ route('task.store') }}" data-lane-id="{{ $lane->id }}" data-url="{{ route('task.form', ['lane_id' => $lane->id]) }}" data-modal-target="taskModal" class="open-task-form w-full inline-flex justify-center rounded-lg  border-1 border-dashed border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-full">
                    <svg class="w-6 h-6 text-gray-600 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 12h14m-7 7V5" />
                    </svg> Add new task </button>
            </div> @endforeach </div>
    </main>
</div> @push('modals') @include('tasks.modal') @include('tasks.delete_modal') @endpush </div>
<script>
    document.querySelectorAll('[data-lane-id]').forEach(el => {
        new Sortable(el, {
            group: 'board',
            animation: 150,
            onAdd: handleChange,
            onEnd: handleChange
        });
    });
    async function handleChange(evt) {
        const lane = evt.to;
        const laneId = lane.dataset.laneId;
        const order = Array.from(lane.querySelectorAll('[data-task-id]')).map(x => x.dataset.taskId);
        await fetch(`{{ url('/lanes') }}/${laneId}/reorder`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                order
            })
        });
    }
    document.querySelectorAll('[data-lane-id]').forEach(el => {
        new Sortable(el, {
            group: 'board',
            animation: 150,
            onAdd: async (evt) => {
                const taskId = evt.item.dataset.taskId;
                const laneId = evt.to.dataset.laneId;
                await fetch(`{{ url('/Task') }}/${taskId}/move`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        lane_id: laneId
                    })
                });
            }
        });
    });
</script> @endsection