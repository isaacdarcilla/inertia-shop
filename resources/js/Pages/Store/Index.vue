<template>
    <Nav :cart="total"/>
    <div class="mt-24 mx-auto max-w-lg">
        <input v-model="this.form.search" type="text" placeholder="Search..."
               class="p-2 mb-3 flex w-full max-w-full bg-white shadow-lg overflow-hidden">
        <div v-for="product in products" :key="product.id" class="py-2">
            <div
                class="flex max-w-full bg-white shadow-lg overflow-hidden hover:bg-gray-200 duration-300">
                <div class="w-3/3 p-4">
                    <h1 class="text-gray-900 font-bold text-2xl">{{ product.name }}</h1>
                    <span
                        class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-indigo-100 bg-indigo-600 rounded-full">{{
                            product.category
                        }}</span>
                    <p class="mt-2 text-gray-600 text-xs">{{ product.description }}</p>
                    <div class="flex item-center justify-between mt-3">
                        <h1 class="text-gray-700 font-bold text-xl">₱ {{ product.price }}</h1>
                        <button :disabled="isLoading" @click="addToCart(product)"
                                class="px-3 py-2 bg-orange-500 text-white text-xs font-bold rounded">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </span>
                        </button>
                    </div>
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

export default {
    components: {
        Loading,
        Nav,
        Head,
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
                this.$inertia.get('/', pickBy(this.form), {preserveState: true})
            }, 150),
        },
    },
    methods: {
        reset() {
            this.form = mapValues(this.form, () => null)
        },
        addToCart(product) {
            this.$inertia.post(`/cart/post/${product.id}`, {product}, {
                onStart: () => (this.isLoading = true),
                onFinish: () => {
                    this.isLoading = false;
                    this.$toast.success(`Added to cart.`, {
                        position: "bottom",
                    });
                },
            })
        },
    },
}
</script>
