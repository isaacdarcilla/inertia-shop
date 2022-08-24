<template>
    <Nav :cart="total"/>
    <div class="mt-24 mx-auto max-w-lg">
        <div class="flex">
            <input v-model="this.form.search" type="text" placeholder="Search..."
                   class="p-2 w-9/12 mb-3 flex max-w-full bg-white shadow-lg overflow-hidden">
            <Link href="/product/create"
                    class="ml-2 w-3/12 p-2 mb-3 text-white text-center mx-auto hover:bg-indigo-400 bg-indigo-500 shadow-lg overflow-hidden">
                    Add
                    Product
            </Link>
        </div>
        <div
            class="flex max-w-full bg-white shadow-lg overflow-hidden">
            <div class="align-middle mx-auto">
                <div class="overflow-x-auto relative text-center">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <tbody>
                        <tr v-for="product in products" :key="product.id"
                            class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th scope="row"
                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ product.name }}
                            </th>
                            <td class="py-4 px-6">
                                {{ product.category }}
                            </td>
                            <td class="py-4 px-6">
                                PHP {{ product.price }}
                            </td>
                            <td class="py-4 px-6 flex">
                                <Link :href="product.url">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </Link>
                                <button @click="deleteProduct(product)"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div v-if="products.length <= 0" class="py-6">
            <p class="text-center">There are no products.</p>
        </div>
    </div>
</template>

<script>
import {Head} from '@inertiajs/inertia-vue3'
import Nav from "../Layout/Nav";
import Loading from "../Layout/Loading";
import {mapValues, pickBy, throttle} from "lodash";
import {Link} from '@inertiajs/inertia-vue3'

export default {
    components: {
        Loading,
        Nav,
        Head,
        Link,
    },
    props: {
        filter: Object,
        products: Object,
        total: Number,
    },
    data() {
        return {
            isLoading: false,
            form: {
                search: this.filter,
            }
        }
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get('/products', pickBy(this.form), {preserveState: true})
            }, 150),
        },
    },
    methods: {
        reset() {
            this.form = mapValues(this.form, () => null)
        },
        deleteProduct(product) {
            this.$inertia.delete(`/product/destroy/${product.id}`, {
                onStart: () => (this.isLoading = true),
                onFinish: () => {
                    this.isLoading = false;
                    this.$toast.success(`Product removed.`, {
                        position: "bottom",
                    });
                },
            })
        },
    },
}
</script>
