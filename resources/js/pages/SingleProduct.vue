<template>
    <div class="container">
        <div v-if="product">
            <h1>{{product.title}}</h1>

            <img class="w-50" v-if="product.cover" :src="product.cover" :alt="product.title">

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
    name: 'SingleProduct',
    data() {
        return {
            product: null
        }
    },
    mounted() {
        axios.get('/api/products/' + this.$route.params.slug)
        .then((response) => {
            // Se abbiamo trovato un product ok popoliamo this.product e lo stampiamo
            if(response.data.success) {
                this.product = response.data.results;
            // Altrimeneti se il product non è stato trovato reindirizziamo l'utente a 404
            } else {
                this.$router.push({name: 'not-found'});
            }
        });
    }
}
</script>