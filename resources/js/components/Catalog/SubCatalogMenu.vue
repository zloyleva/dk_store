<template>
    <div>
        <ul class="list-unstyled catalog_menu sub_menu" v-if="categories.length">
            <li v-for="category in categories" class="catalog_menu-item" :key="category.id">
                <a class="catalog_menu-item-link"
                   :href="`${routes.catalog}/${category.slug}`">{{ category.name }}</a>
            </li>
        </ul>

    </div>
</template>

<script>

    export default {
        name: "SubCatalogMenu",
        props:['categories','routes'],
    }
</script>

<style scoped>
    .sub_menu a.catalog_menu-item-link{
        margin-left: 7px ;
        display:block;
    }
</style>
