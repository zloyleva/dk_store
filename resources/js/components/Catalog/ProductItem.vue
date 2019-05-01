<template>
    <div class="col-12 col-md-6 col-xl-4 p-2">

        <div class="card  w-100 h-100">
            <img src="/storage/images/no-photo.png" class="card-img-top" alt="">
            <div class="card-body d-flex flex-column">
                <div class="category mb-2">
                    Категория: <a :href="`/catalog/${product.categories.slug}`">{{ product.categories.name }}</a>
                </div>
                <h5 class="card-title font-weight-bold flex-grow-1">{{ product.name }}</h5>
                <div class="card-text">Количество: {{ product.stock }}</div>
                <div class="card-text">Тип цены: {{ product.price_desc }}</div>
                <div class="card-text">Цена: <b>{{ product.price }}</b> грн</div>
                <div class="controls">
                    <a :href="`/product/${product.id}/${product.slug}`" class="btn btn-secondary mt-2">Подробнее</a>
                    <button class="btn btn-danger mt-2" @click="addToCartHandler">В корзину</button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "ProductItem",
        props:{
            product:{
                type: Object,
                required: true
            }
        },
        methods:{
            addToCartHandler(){
                console.log("addToCartHandler - product");

                this.$emit("addtocart", this.product);
            }
        }
    }
</script>

<style scoped>

</style>
