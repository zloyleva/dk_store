<template>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">

        <div class="p-2">

            <div class="card p-3">

                <h3 class="h5">Разделы каталога</h3>

                <ul class="list-unstyled catalog_menu">
                    <li v-for="category in categories" class="catalog_menu-item" :key="category.id">
                        <a class="catalog_menu-item-link font-weight-bolder"
                           :href="`${routes.catalog}/${category.slug}`">{{ category.name }}</a>

                        <sub-catalog-menu-component
                            :categories="category.children"
                            :routes="routes"
                        ></sub-catalog-menu-component>

                    </li>
                </ul>
            </div>

        </div>

    </div>
</template>

<script>

    Vue.component('sub-catalog-menu-component', require('./SubCatalogMenu').default);

    export default {
        name: "CatalogMenu",
        props:['categories', 'routes']
    }
</script>

<style scoped>

</style>
