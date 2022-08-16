<template>
    <Nav :cart="total"/>

    <div v-if="carts.length > 0" class="mt-24 mb-4 mx-auto max-w-lg">
        <div
            class="flex max-w-full bg-white shadow-lg overflow-hidden">
            <div class="align-middle mx-auto">
                <div class="overflow-x-auto relative text-center">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <tbody>
                        <tr v-for="cart in carts" :key="cart.id"
                            class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th scope="row"
                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ cart.product }}
                            </th>
                            <td class="py-4 px-6">
                                {{ cart.category }}
                            </td>
                            <td class="py-4 px-6">
                                PHP {{ cart.price }}
                            </td>
                            <td class="py-4 px-6">
                                <button @click="deleteCart(cart)"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr
                            class="border-0 bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th colspan="2" class="py-4 px-6">
                                Total
                            </th>
                            <td colspan="2" class="py-4 px-6 font-bold border-0">
                                PHP {{ total_price }}
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div v-if="carts.length > 0" class="mx-auto max-w-lg mb-16">
        <Link href="/cart/checkout">
            <button
                class="w-full h-8 px-6 text-indigo-100 transition-colors duration-150 bg-yellow-600 focus:shadow-outline hover:bg-indigo-800">
                Proceed to Checkout
            </button>
        </Link>

    </div>
    <div v-if="carts.length <= 0" class="py-6 mt-24">
        <p class="text-center">Cart is empty.</p>
    </div>
</template>

<script>
import Nav from "../Layout/Nav";
import {Link} from '@inertiajs/inertia-vue3';

export default {
    components: {
        Nav,
        Link,
    },
    props: {
        filter: Object,
        carts: Object,
        total: Number,
        total_price: Number,
    },
    methods: {
        deleteCart(cart) {
            this.$inertia.delete(`/cart/destroy/${cart.id}`, {
                onStart: () => (this.isLoading = true),
                onFinish: () => {
                    this.isLoading = false;
                    this.$toast.success(`Removed to cart.`, {
                        position: "bottom",
                    });
                },
            })
        },
    },
}
</script>
