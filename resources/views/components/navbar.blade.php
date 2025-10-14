<nav
    class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50"
>
    <div class="flex flex-wrap justify-between items-center">
        <div class="flex justify-start items-center">
            <a href="#" class="flex items-center justify-between mr-4">
                <img
                    src="{{ asset('taskboard_logo.svg') }}"
                    class="mr-1 h-12"
                    alt="TaskBoard Logo"
                />
                <span
                    class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"
                    >TASKBOARD</span
                >
            </a>
        </div>

        <div class="flex items-center lg:order-2">
            <button
                type="button"
                class="elative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600"
                id="user-menu-button"
                aria-expanded="false"
                data-dropdown-toggle="dropdown"
            >
                <span class="font-medium text-gray-600 dark:text-gray-300"
                    >{{ get_initials(Auth::user()->name) }}</span
                >
            </button>
            <!-- Dropdown menu -->
            <div
                class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
                id="dropdown"
            >
                <div class="py-3 px-4">
                    <span
                        class="block text-sm font-semibold text-gray-900 dark:text-white"
                        >{{Auth::user()->name}}</span
                    >
                    <span
                        class="block text-sm text-gray-900 truncate dark:text-white"
                        >{{Auth::user()->email}}</span
                    >
                </div>

                <ul
                    class="py-1 text-gray-700 dark:text-gray-300"
                    aria-labelledby="dropdown"
                >
                    <li>
                        <form method="GET" action="{{ route('logout') }}">
                            @csrf
                            <a
                                href="{{ route('logout') }}"
                                class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                >Sign out</a
                            >
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
