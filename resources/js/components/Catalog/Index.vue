<template>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-3">
                Store name
            </div>
            <div class="col-12 col-sm-9">

                <div class="container">
                    <div class="row">
                        <product-item-component v-for="item in products.data"
                                                :product="item" :key="item.id"
                        ></product-item-component>
                    </div>
                </div>

            </div>
        </div>

        <pagination-component :last_page="products.last_page"></pagination-component>

    </div>
</template>

<script>

    Vue.component('product-item-component', require('./ProductItem').default);
    Vue.component('pagination-component', require('./Pagination').default);

    export default {
        name: "Index",
        props:{
            products:{
                type: Object,
                required: true
            }
        },
    }
</script>

<style scoped>

</style>
