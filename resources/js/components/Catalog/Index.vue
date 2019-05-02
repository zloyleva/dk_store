<template>
    <div class="container">
        <div class="row">

            <catalog-menu-component
                :categories="categories"
                :routes="routes"
            ></catalog-menu-component>

            <div class="col-12 col-sm-7 col-md-8 col-lg-9">

                <div class="d-flex flex-wrap">
                    <search-and-filter-component
                        :request="request"
                    ></search-and-filter-component>

                    <product-item-component
                        v-for="item in products.data"
                        :product="item" :key="item.id"
                        :routes="routes"
                    ></product-item-component>
                </div>

            </div>
        </div>

        <pagination-component
            :last_page="products.last_page"
            :request="request"
        ></pagination-component>

    </div>
</template>

<script>

    Vue.component('product-item-component', require('./ProductItem').default);
    Vue.component('search-and-filter-component', require('./SearchAndFilter').default);
    Vue.component('pagination-component', require('./Pagination').default);
    Vue.component('catalog-menu-component', require('./CatalogMenu').default);

    export default {
        name: "Index",
        props:{
            products:{
                type: Object,
                required: true
            },
            request:{
                type: [Array, Object],
            },
            routes:{
                type: Object,
                required: true
            },
            categories:{
                type: Array,
                required: true
            }
        },
        methods:{
            addToCartHandler(product){
                console.log("addToCartHandler - catalog", product);

                axios.post(this.routes.addToCart,{
                    product_id: product.id
                })
                    .then(res => {
                        console.log(res)
                    })
            }
        }
    }
</script>

<style scoped>

</style>
