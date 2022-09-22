<template>
    <div class="card mt-3">
        <div class="card-body">
            <img class="w-100" v-if="product.cover" :src="product.cover" :alt="product.product">
            <h5 class="card-title">{{ product.title }}</h5>
            <p class="card-text">{{ truncateText(product.content) }}</p>
            <router-link 
                class="btn btn-primary" 
                :to="{
                    name: 'single-product', 
                    params: { slug: product.slug }
                }"
                >
            Leggi
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductDatails',
    props: {
        product: Object
    },
    methods: {
        truncateText(text) {
            return text.length > 75 ? text.slice(0, 75) + '...' : text;
        }
    }
}
</script>