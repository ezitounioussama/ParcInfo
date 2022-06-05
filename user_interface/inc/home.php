<?php
require_once 'header.php';
?>
<header class="bg-gray-50">
    <div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center sm:justify-between sm:gap-4">
            <div class="relative hidden sm:block">
                <label class="sr-only" for="search"> Search </label>

                <input class="w-full h-10 pl-4 pr-10 text-sm bg-white border-none rounded-lg shadow-sm sm:w-56" id="search" type="search" placeholder="Search website..." />

                <button class="absolute p-2 text-gray-600 transition -translate-y-1/2 rounded-md hover:text-gray-700 bg-gray-50 top-1/2 right-1" type="button" aria-label="Submit Search">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            <div class="flex items-center justify-between flex-1 gap-8 sm:justify-end">
                <div class="flex gap-4">
                    <button type="button" class="block sm:hidden p-2.5 text-gray-600 bg-white rounded-lg hover:text-gray-700 shrink-0 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>


                </div>

                <button type="button" class="flex items-center transition rounded-lg group shrink-0">
                    <img class="object-cover w-10 h-10 rounded-full" src="https://www.morbius.movie/images/gallery/img2.jpg" alt="Simon Lewis" />

                    <p class="hidden ml-2 text-xs text-left sm:block">
                        <strong class="block font-medium">Your Name</strong>

                        <span class="text-gray-500"> your informations</span>
                    </p>


                </button>
            </div>
        </div>

        <div class="mt-8">
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                Welcome Back, 'Name'
            </h1>


        </div>
    </div>
</header>



<section>


    <div class="relative mx-auto max-w-screen-2xl">
        <div>


            <div class="py-12 bg-white md:py-24">
                <div class="max-w-lg px-4 mx-auto lg:px-8">
                    <form class="grid grid-cols-6 gap-4">
                        <div class="col-span-3">
                            <label class="block mb-1 text-sm text-gray-600" for="first_name">
                                Material Name
                            </label>

                            <input class="border border-gray-100 rounded-lg shadow-sm  w-full text-sm p-2.5" type="text" id="frst_name" />
                        </div>

                        <div class="col-span-3">
                            <label class=" block mb-1 text-sm text-gray-600" for="last_name">
                                Serie
                            </label>

                            <input class="border border-gray-100 rounded-lg shadow-sm  w-full text-sm p-2.5" type="text" id="last_name" />
                        </div>

                        <div class="col-span-6">

                            <div class="grid grid-cols-2 gap-8">
                                <div class="relative">
                                    <input class="hidden group peer" type="radio" name="shippingOption" value="standard_alt" id="standard_alt" />

                                    <label class="block p-4 text-sm font-medium transition-colors border border-gray-100 rounded-lg shadow-sm cursor-pointer peer-checked:border-blue-500 hover:bg-gray-50 peer-checked:ring-1 peer-checked:ring-blue-500" for="standard_alt">
                                        <span> New </span>

                                    </label>

                                    <svg class="absolute w-5 h-5 text-blue-600 opacity-0 top-4 right-4 peer-checked:opacity-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <div class="relative">
                                    <input class="hidden group peer" type="radio" name="shippingOption" value="next_day_alt" id="next_day_alt" />

                                    <label class="block p-4 text-sm font-medium transition-colors border border-gray-100 rounded-lg shadow-sm cursor-pointer peer-checked:border-blue-500 hover:bg-gray-50 peer-checked:ring-1 peer-checked:ring-blue-500" for="next_day_alt">
                                        <span> Used </span>


                                    </label>

                                    <svg class="absolute w-5 h-5 text-blue-600 opacity-0 top-4 right-4 peer-checked:opacity-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>

                        </div>



                        <fieldset class="col-span-6">
                            <legend class="block mb-1 text-sm text-gray-600">
                                Informations
                            </legend>

                            <div class="-space-y-px bg-white rounded-lg shadow-sm">
                                <textarea id="about" name="description" rows="3" class="border p-3 shadow-sm mt-1 block w-full sm:text-sm border-gray-100 rounded-md" placeholder="specifications.."></textarea>
                            </div>
                        </fieldset>

                        <fieldset class="col-span-6">
                            <legend class="block mb-1 text-sm text-gray-600">
                                From where ?
                            </legend>

                            <div class="-space-y-px bg-white rounded-md shadow-sm">
                                <div>
                                    <label class="sr-only" for="country">Country</label>

                                    <select class="border border-gray-200 relative rounded-t-lg w-full focus:z-10 text-sm p-2.5" id="country" name="country" autocomplete="country-name">
                                        <option>Rabat</option>
                                        <option>Sale</option>
                                        <option>Kenitra</option>
                                        <option>Casablanca</option>
                                        <option>Marrakech</option>
                                        <option>Tanger</option>
                                    </select>
                                </div>


                            </div>
                        </fieldset>


                        <fieldset class="col-span-6">
                            <legend class="block mb-1 text-sm text-gray-600">
                                Category
                            </legend>

                            <div class="-space-y-px bg-white rounded-md shadow-sm">
                                <div>
                                    <label class="sr-only" for="country">Category</label>

                                    <select class="border border-gray-200 relative rounded-t-lg w-full focus:z-10 text-sm p-2.5" id="country" name="country" autocomplete="country-name">
                                        <option>Screen</option>
                                        <option>Keyboard</option>
                                        <option>Mouse</option>
                                        <option>Printer</option>
                                        <option>Computer-system-inheit</option>
                                        <option>Cables</option>
                                    </select>
                                </div>


                            </div>
                        </fieldset>


                        <div class="col-span-6">
                            <button class="rounded-lg bg-black text-sm p-2.5 text-white w-full block" type="submit">
                                Insert
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



<?php
require_once 'footer.php';
?>