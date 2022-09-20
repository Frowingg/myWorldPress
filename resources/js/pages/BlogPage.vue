<template>
    <div class="container">
        <h1>Blogpage</h1>

        <Products />
    </div>
</template>

<script>
import Products from '../components/Products.vue';

export default {
    name: 'HomePage',
    components: {
        Products
    }
}
</script>