<template>
    <div class="flex items-center justify-between py-4">
        <button
            class="focus:outline-none text-white rounded-md cursor-pointer text-xs font-semibold px-3 py-2 bg-indigo-700"
            v-on:click.prevent="addToCart"
        >
            Add to Cart
        </button>
    </div>
</template>

<script setup>
    import useCart from '../composables/cart/products.js';
    const { addProduct, cartCount } = useCart();
    const props = defineProps(['productId']);
    const emitter = require('tiny-emitter/instance');
    const { inject } = require('vue');
    const toast = inject('toast');

    const addToCart = async () => {
        await axios.get('/sanctum/csrf-cookie')
        const cartResp = await axios.get('/api/user')
            .then(async () => {
                await addProduct(props.productId);
                toast.success('Product added to cart!');
                emitter.emit('refreshCartCount', cartCount);
            })
            .catch((error) => {
                toast.error('Cannot add to cart now. Sorry! There are some server error or please login for add to cart.');
                return;
            });
    }
</script>
