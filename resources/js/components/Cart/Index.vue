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
                            <th scope="col">Количество</th>
                            <th scope="col">Сумма</th>
                        </tr>
                    </thead>
                    <tbody>

                        <cart_item-component
                            v-for="(item, i) in items" :key="item.id" :item="item" :i="i"
                        ></cart_item-component>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    Vue.component('cart_item-component', require('./CartItem').default);
    export default {
        name: "Index",
        props:{
            items:{
                type: Array
            }
        },
        methods:{
            changeInputProductsCount(){
                console.log("changeInputProductsCount");
                _.debounce(() => console.log("debounce"), 200)

            },
            changProductsCountHandler(){
                console.log("debounce")
            }
        },
    }
</script>

<style scoped>
    .table th{
        border-top: unset;
    }
</style>
