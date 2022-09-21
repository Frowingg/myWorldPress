<template>
    <div class="container">
        <div v-if="product">
            <h1>{{product.title}}</h1>

            <div v-if="product.tags.length > 0">
                <span v-for="tag in product.tags" :key="tag.id" class="badge bg-info text-dark mr-1">{{tag.name}}</span>
            </div>

            <div v-if="product.category">Category: {{product.category.name}}</div>

            <p>{{product.content}}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SinglePost',
    data() {
        return {
            product: null
        }
    },
    mounted() {
        axios.get('/api/products/' + this.$route.params.slug)
        .then((response) => {
            this.product = response.data.results;
        });
    }
}
</script>