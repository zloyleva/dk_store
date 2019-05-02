<template>
    <div class="col-12 col-md-6 col-xl-4 p-2">

        <div class="card  w-100 h-100">
            <img src="/storage/images/no-photo.png" class="card-img-top" alt="">

            <product-meta-component
                :product="product"
                :routes="routes"
                :catalog="true"
            ></product-meta-component>

        </div>

    </div>
</template>

<script>
    Vue.component('product-meta-component', require('../Product/ProductMainMeta').default);

    export default {
        name: "ProductItem",
        props:{
            product:{
                type: Object,
                required: true
            },
            routes:{
                type: Object,
                required: true
            }
        },
        methods:{

        }
    }
</script>

<style scoped>

</style>
