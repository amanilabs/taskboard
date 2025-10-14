<!-- Main modal -->
<div
    id="taskModal"
    tabindex="-1"
    aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
>
    <div class="relative p-4 w-full max-w-6xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200"
            >
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add new task
                </h3>
                <button
                    type="button"
                    data-close="true"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                >
                    <svg
                        class="w-3 h-3"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 14 14"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                        />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form
                id="taskForm"
                class="p-4 md:p-5"
                method="POST"
                action="{{route('task.store')}}"
                enctype="multipart/form-data"
            >
                @CSRF
                <div id="taskModalBody"></div>

                <button
                    type="submit"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    <svg
                        class="w-5 h-5 text-gray-800 dark:text-white"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    Save
                </button>
                <button
                    data-close="true"
                    type="button"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                >
                    Cancel
                </button>
            </form>
        </div>
    </div>
</div>

<script>


    document.addEventListener('DOMContentLoaded', () => {
      const el = document.getElementById('taskModal');
      if (!el) return;

      const modal = new Modal(el, { backdrop: 'dynamic' });

      const body = document.getElementById('taskModalBody');

      document.addEventListener('click', async (e) => {
        const btn = e.target.closest('.open-task-form');
        if (!btn) return;

        e.preventDefault();
        try {
          const html = await fetch(btn.dataset.url, { headers: { Accept: 'text/html' } }).then(r => r.text());
          body.innerHTML = html;
          modal.show();
        } catch {
          alert('Could not load the form.');
        }
      });

      el.addEventListener('click', (e) => {
        if (e.target.matches('[data-close]')) modal.hide();
      });
    });
</script>
