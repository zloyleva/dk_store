<template>
    <div class="card-body d-flex flex-column">
        <div class="category mb-2">
            Категория: <a :href="`/catalog/${product.categories.slug}`">{{ product.categories.name }}</a>
        </div>
        <h5 class="card-title font-weight-bold flex-grow-1">{{ product.name }}</h5>
        <div class="card-text">Количество: {{ product.stock }}</div>
        <div class="card-text">Тип цены: {{ product.price_desc }}</div>
        <div class="card-text">Цена: <b>{{ product.price }}</b> грн</div>
        <div class="controls">
            <a v-if="catalog" :href="`/product/${product.id}/${product.slug}`" class="btn btn-secondary mt-2">Подробнее</a>
            <button class="btn btn-danger mt-2" @click="pushProductToCart(product)">В корзину</button>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'

    export default {
        name: "ProductMainMeta",
        props:{
            product:{

            },
            catalog:{
                type: Boolean
            },
            routes:{
                type: Object,
                required: true
            }
        },
        methods:{
            ...mapActions('cart', [
                'pushProductToCart'
            ]),
        },
        created () {
            this.$store.commit('cart/setRoutes', this.routes)
        }
    }
</script>

<style scoped>

</style>
