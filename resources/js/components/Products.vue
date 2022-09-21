<template>
    <section>
        <div class="container">
            <h1>{{ pageTitle }}</h1>

            <div class="row row-cols-3">

                <div class="col" v-for="product in products" :key="product.id">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="card-title">{{ product.title }}</div>
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
                </div>
            </div>

            <nav class="mt-3">
                <ul class="pagination">
                    <li class="page-item" :class="{'disabled': currentPaginationPage == 1}">
                        <a class="page-link" @click.prevent="getProducts(currentPaginationPage - 1)" href="#">Previous</a>
                    </li>
                    <li v-for="pageNumber in lastPaginationPage" :key="pageNumber" class="page-item" :class="{'active': pageNumber == currentPaginationPage}">
                        <a @click.prevent="getProducts(pageNumber)" class="page-link" href="#">{{ pageNumber }}</a>
                    </li>
                    <li class="page-item" :class="{'disabled': currentPaginationPage == lastPaginationPage}">
                        <a class="page-link" @click.prevent="getProducts(currentPaginationPage + 1)" href="#">Next</a>
                    </li>
                </ul>
            </nav>

        </div>
    </section>
</template>

<script>

export default {
    name: 'Products',
    data() {
        return {
            pageTitle: 'Our Products',
            products: [], 
            currentPaginationPage: 1,
            lastPaginationPage: null
        }
    },
    methods: {
        getProducts(pageNumber) {
            axios.get('/api/products', {
                params: {
                    page: pageNumber
                }
            })
            .then((response) => {
                this.products = response.data.results.data;
                this.currentPaginationPage = response.data.results.current_page;
                this.lastPaginationPage = response.data.results.last_page;
            });
        },
        truncateText(text) {
            return text.length > 75 ? text.slice(0, 75) + '...' : text;
        }
    },
    mounted() {
        this.getProducts(1);
    }
}
</script>