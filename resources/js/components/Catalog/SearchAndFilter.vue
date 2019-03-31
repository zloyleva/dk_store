<template>
    <div class="container">
        <div class="row">

            <div class="col-12 p-2">
                <div class="card">
                    <form action="" class="m-3" @submit.prevent="submitFilterHandler">

                        <div class="form-row">
                            <div class="form-group col-lg-7">
                                <label for="product_name_search">Поиск по названию товара или SKU</label>
                                <div class="d-flex">
                                    <input name="search" type="text" class="form-control mr-2" v-model="search"
                                           id="product_name_search" placeholder="Введите название товра или SKU для поиска">
                                    <button type="submit" class="btn btn-outline-secondary"><font-awesome-icon icon="search" /></button>
                                </div>
                            </div>

                            <div class="form-group col-lg-5">
                                <label for="sort_products">Сортировка товаров</label>
                                <select id="sort_products" class="form-control">
                                    <option>Выберите сортировку товаров</option>
                                    <option>От дешевых к дорогим</option>
                                    <option>От дорогих к дешевым</option>
                                </select>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "SearchAndFilter",
        props:{
            request:{
                type: [Array, Object],
            }
        },
        data(){
            return {
                search:"",
            }
        },
        mounted(){
            this.search = this.request.search ? this.request.search: "";
        },
        methods:{
            submitFilterHandler(e){
                console.log("submitFilterHandler");
                e.target.submit();
            }
        }
    }
</script>

<style scoped>
    .card{
        box-shadow: 0px 1px 3px 0px rgba(0,0,0,0.2), 0px 1px 1px 0px rgba(0,0,0,0.14), 0px 2px 1px -1px rgba(0,0,0,0.12);
    }
</style>
