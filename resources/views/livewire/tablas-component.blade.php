<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12 rounded-3xl">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-3xl">
                <div class="overflow-hidden shadow-xl sm:rounded-lg rounded-3xl">
                    {{-- <x-welcome /> --}}

                    <div class="relative overflow-x-auto shadow-md sm:rounded-3xl p-4 rounded-3xl">
                        <div
                            class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900 rounded-3xl">
                            <div class="rounded-3xl">
                                <button
                                    class="relative inline-flex  items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-full group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                    <span
                                        class="relative px-4  py-4 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-full group-hover:bg-opacity-0 text-purple-700 hover:text-white "
                                        style="font-size: 20px">
                                        <i class="fa-regular fa-circle-plus"></i>
                                    </span>
                                </button>
                                <button
                                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-full group bg-gradient-to-br from-red-600 to-red-500 group-hover:from-red-600 group-hover:to-red-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                    <span
                                        class="relative px-4  py-4 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-full group-hover:bg-opacity-0 text-red-700 hover:text-white"
                                        style="font-size: 20px">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </span>
                                </button>
                                <button
                                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-full group bg-gradient-to-br from-green-600 to-green-500 group-hover:from-green-600 group-hover:to-green-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                    <span
                                        class="relative px-4  py-4 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-full group-hover:bg-opacity-0 text-green-700 hover:text-white"
                                        style="font-size: 20px">
                                        <i class="fa-solid fa-file-excel"></i>
                                    </span>
                                </button>
                                <button
                                    class="relative inline-flex   items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-full group bg-gradient-to-br from-gray-600 to-gray-500 group-hover:from-gray-600 group-hover:to-gray-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                    <span
                                        class="relative px-4  py-4 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-full group-hover:bg-opacity-0 text-green-700 hover:text-white"
                                        style="font-size: 20px">
                                        <i class="fa-solid fa-print"></i>
                                    </span>
                                </button>


                            </div>
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" id="table-search-users"
                                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search for users">
                            </div>
                        </div>
                        <div
                            class="w-full text-sm text-left rtl:text-right bg-gray-100 text-gray-600 dark:text-gray-400 rounded-3xl overflow-hidden border-2 border-purple-700">
                            <table
                                class="w-full text-sm text-left rtl:text-right bg-gray-100 text-gray-600 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-200 uppercase bg-purple-700 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-all-search" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-purple-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Position
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <th scope="row"
                                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <img class="w-10 h-10 rounded-full"
                                                src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                                            <div class="ps-3">
                                                <div class="text-base font-semibold">Neil Sims</div>
                                                <div class="font-normal text-gray-500">neil.sims@flowbite.com</div>
                                            </div>
                                        </th>
                                        <td class="px-6 py-4">
                                            React Developer
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <!-- Modal toggle -->
                                            <a href="#" type="button" data-modal-target="editUserModal"
                                                data-modal-show="editUserModal"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                user</a>
                                        </td>
                                    </tr>
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <th scope="row"
                                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <img class="w-10 h-10 rounded-full"
                                                src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                                            <div class="ps-3">
                                                <div class="text-base font-semibold">Neil Sims</div>
                                                <div class="font-normal text-gray-500">neil.sims@flowbite.com</div>
                                            </div>
                                        </th>
                                        <td class="px-6 py-4">
                                            React Developer
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <!-- Modal toggle -->
                                            <a href="#" type="button" data-modal-target="editUserModal"
                                                data-modal-show="editUserModal"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                user</a>
                                        </td>
                                    </tr>
                                    <!-- Repetir las filas necesarias -->
                                </tbody>
                            </table>
                        </div>



                        <!-- Edit user modal -->
                        <div id="editUserModal" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <form class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Edit user
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="editUserModal">
                                            <svg class="w-3 h-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="first-name"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                                                    Name</label>
                                                <input type="text" name="first-name" id="first-name"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Bonnie" required="">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="last-name"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                                                    Name</label>
                                                <input type="text" name="last-name" id="last-name"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Green" required="">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="email"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                                <input type="email" name="email" id="email"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="example@company.com" required="">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="phone-number"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                                                    Number</label>
                                                <input type="number" name="phone-number" id="phone-number"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="e.g. +(12)3456 789" required="">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="department"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                                                <input type="text" name="department" id="department"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Development" required="">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="company"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
                                                <input type="number" name="company" id="company"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="123456" required="">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="current-password"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current
                                                    Password</label>
                                                <input type="password" name="current-password" id="current-password"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="••••••••" required="">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="new-password"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New
                                                    Password</label>
                                                <input type="password" name="new-password" id="new-password"
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="••••••••" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div
                                        class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save
                                            all</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </x-app-layout>
</div>