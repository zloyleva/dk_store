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
                                                :product="item"
                        ></product-item-component>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

    Vue.component('product-item-component', require('./ProductItem').default);

    export default {
        name: "Index",
        props:{
            products:{
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
