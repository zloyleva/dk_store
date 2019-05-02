<template>

    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card flex-row flex-wrap py-3">

                    <div class="col-12 col-md-5">
                        <img src="/storage/images/no-photo.png" class="card-img-top" alt="">
                    </div>
                    <div class="col-12 col-md-7">

                        <product-meta-component
                            :product="product"
                            :routes="routes"
                        ></product-meta-component>

                    </div>

                </div>

            </div>

            <div class="col-12 mt-3">
                <div class="card flex-row flex-wrap py-3">
                    <div class="col-12">
                        <h3>Описание:</h3>
                        <p>
                            {{ product.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    Vue.component('product-meta-component', require('./ProductMainMeta').default);
    export default {
        name: "IndexComponent",
        props:{
            product:{
                type: Object,
                require: true
            },
            routes:{
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
