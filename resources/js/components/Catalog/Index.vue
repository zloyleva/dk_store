<template>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-3">
                Store name
            </div>
            <div class="col-12 col-sm-9">

                <search-and-filter-component
                    :request="request"
                ></search-and-filter-component>

                <div class="container">
                    <div class="row">
                        <product-item-component v-for="item in products.data"
                                                :product="item" :key="item.id"
                        ></product-item-component>
                    </div>
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

    export default {
        name: "Index",
        props:{
            products:{
                type: Object,
                required: true
            },
            request:{
                type: [Array, Object],
            }
        },
    }
</script>

<style scoped>

</style>
