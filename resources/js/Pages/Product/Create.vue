<template>
    <Nav :cart="total"/>

    <div class="mt-24 mb-4 mx-auto max-w-lg">
        <div
            class=" max-w-full bg-white shadow-lg overflow-hidden">
            <div class="mx-4">

                <div class="flex flex-col md:w-full mx-auto h-auto">
                    <h2 class="mb-4 font-bold md:text-xl text-heading mt-3">Create New Product
                    </h2>
                    <form @submit.prevent="submit" class="justify-center w-full mx-auto" method="post" action="">
                        <div class="">
                            <div class="space-x-0 lg:flex lg:space-x-4">
                                <div class="w-full lg:w-1/2">
                                    <label for="item_name" class="block mb-3 text-sm font-semibold text-gray-500">Item
                                        Name</label>
                                    <input name="item_name" v-model="form.item_name" type="text" placeholder="Item name"
                                           class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <div class="text-red-600" v-if="errors.item_name">{{ errors.item_name }}</div>
                                </div>
                                <div class="w-full lg:w-1/2 ">
                                    <label for="category" class="block mb-3 text-sm font-semibold text-gray-500">Category</label>
                                    <select name="category" v-model="form.item_category"
                                            class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                                        <option selected disabled value="null">Select category</option>
                                        <option v-for="category in categories" :value="category.id">
                                            {{ category.name }}
                                        </option>
                                    </select>
                                    <div class="text-red-600" v-if="errors.item_category">{{ errors.item_category }}</div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="space-x-0 lg:flex lg:space-x-4">
                                    <div class="w-full lg:w-full">
                                        <label for="price" class="block mb-3 text-sm font-semibold text-gray-500">Item
                                            Price</label>
                                        <input name="price" v-model="form.item_price" type="text"
                                               placeholder="Item price"
                                               class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                                        <div class="text-red-600" v-if="errors.item_price">{{ errors.item_price }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="w-full">
                                    <label for="Description"
                                           class="block mb-3 text-sm font-semibold text-gray-500">Description</label>
                                    <textarea v-model="form.item_description"
                                              class="w-full px-4 py-3 text-xs border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600"
                                              name="Description" cols="20" rows="4"
                                              placeholder="Description..."></textarea>
                                    <div class="text-red-600" v-if="errors.item_description">{{ errors.item_description }}</div>
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
        categories: Object,
        errors: Object,
    },
    data() {
        return {
            form: {
                item_name: null,
                item_price: null,
                item_category: null,
                item_description: null,
            },
        }
    },
    methods: {
        submit() {
            this.$inertia.post(`/product/store`, this.form, {
                onSuccess: () => {
                    this.$toast.success(`Product added.`, {
                        position: "bottom",
                    });
                }
            })
        }
    },
}
</script>
