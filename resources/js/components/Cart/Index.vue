<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Козина</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 card">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Кол-во</th>
                            <th scope="col" class="d-none d-sm-flex">Сумма</th>
                        </tr>
                    </thead>
                    <tbody>

                        <cart_item-component
                            v-for="(item, i) in cartItems" :key="item.id" :item="item" :i="i"
                            @changeItemCount="changeItemCountHandler"
                        ></cart_item-component>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-12 card">
                <div class="container">
                    <div class="row my-2">
                        <div class="col-9 text-right font-weight-bold">Всего:</div>
                        <div class="col-3 text-center">
                            <font-awesome-icon v-if="isUploadCart" icon="sync" spin class="mr-1"/>
                            {{ total }} грн
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <order-component></order-component>

    </div>
</template>

<script>
    Vue.component('cart_item-component', require('./CartItem').default);
    Vue.component('order-component', require('./OrderComponent').default);
    export default {
        name: "Index",
        props:{
            items:{
                type: Array,
                require:true
            },
            routes:{
                type: Object,
                require:true
            }
        },
        data(){
            return{
                cartItems: [],
                isUploadCart: false,
            }
        },
        created(){
            this.cartItems = [...this.items];
        },
        computed:{
            total(){
                return parseFloat(this.cartItems.reduce((sum, el) => sum + (el.count * el.product.price), 0)).toFixed(2);
            }
        },
        methods:{
            async changeItemCountHandler(cartItem){
                console.log("changeItemCountHandler",cartItem);

                this.isUploadCart = true;

                await axios.post(this.routes.setItemCountInCart,{
                    product_id: cartItem.product.id,
                    count: cartItem.count,
                })
                    .then(res => {
                        console.log(res.data.items);
                        this.cartItems = [...res.data.items];
                    })
                    .catch(err => console.log(err.message));

                this.isUploadCart = false;
            }
        },
    }
</script>

<style scoped>
    .table th{
        border-top: unset;
    }
    .table thead th {
        vertical-align: bottom;
        border-bottom: 1px solid #dee2e6;
    }
</style>
