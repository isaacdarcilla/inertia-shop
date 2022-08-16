<template>
    <Nav :cart="total"/>

    <div v-if="carts.length > 0" class="mt-24 mb-4 mx-auto max-w-lg">
        <div
            class=" max-w-full bg-white shadow-lg overflow-hidden">
            <div class="mx-4">
                <div class="flex flex-col md:w-full mx-auto">
                    <h2 class="mb-4 font-bold md:text-xl text-heading mt-3">Shipping Address
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
                    </form>
                </div>
            </div>
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
        <button @click="checkout"
                class="w-full h-8 px-6 text-indigo-100 transition-colors duration-150 bg-yellow-600 focus:shadow-outline hover:bg-indigo-800">
            Pay Now
        </button>
    </div>
    <div v-if="carts.length <= 0" class="py-6 mt-24">
        <p class="text-center">Cart is empty.</p>
    </div>
</template>

<script>
import Nav from "../Layout/Nav";

export default {
    components: {
        Nav,
    },
    props: {
        filter: Object,
        carts: Object,
        total: Number,
        total_price: Number,
    },
    methods: {
        checkout() {
            this.$inertia.post(`/cart/update`, {carts: this.carts}, {
                onStart: () => (this.isLoading = true),
                onFinish: () => {
                    this.isLoading = false;
                    this.$toast.success(`Checkout success.`, {
                        position: "bottom",
                    });
                },
            })
        },
    },
}
</script>
