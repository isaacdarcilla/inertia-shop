<template>
    <Nav :cart="total"/>

    <div class="mt-24 mb-4 mx-auto max-w-lg">
        <div
            class=" max-w-full bg-white shadow-lg overflow-hidden">
            <div class="mx-4">

                <div class="flex flex-col md:w-full mx-auto h-auto">
                    <h2 class="mb-4 font-bold md:text-xl text-heading mt-3">Edit {{ product.name }}
                    </h2>
                    <form class="justify-center w-full mx-auto" method="post" action="">
                        <div class="">
                            <div class="space-x-0 lg:flex lg:space-x-4">
                                <div class="w-full lg:w-1/2">
                                    <label for="firstName" class="block mb-3 text-sm font-semibold text-gray-500">First
                                        Name</label>
                                    <input name="firstName" value="Isaac" type="text" placeholder="First Name"
                                           class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                                </div>
                                <div class="w-full lg:w-1/2 ">
                                    <label for="firstName" class="block mb-3 text-sm font-semibold text-gray-500">Last
                                        Name</label>
                                    <input value="Arcilla" name="Last Name" type="text" placeholder="Last Name"
                                           class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="w-full">
                                    <label for="Email"
                                           class="block mb-3 text-sm font-semibold text-gray-500">Email</label>
                                    <input value="isaacdarcilla@gmail.com" name="Last Name" type="text"
                                           placeholder="Email"
                                           class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="w-full">
                                    <label for="Address"
                                           class="block mb-3 text-sm font-semibold text-gray-500">Address</label>
                                    <textarea value="Bicol Region"
                                              class="w-full px-4 py-3 text-xs border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600"
                                              name="Address" cols="20" rows="4" placeholder="Address"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                                class="w-full my-4 h-8 px-6 text-indigo-100 transition-colors duration-150 bg-yellow-600 focus:shadow-outline hover:bg-indigo-800">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3'
import Nav from "../Layout/Nav";

export default {
    components: {
        Link,
        Nav,
    },
    props: {
        total: Number,
        product: Object,
    },
}
</script>
