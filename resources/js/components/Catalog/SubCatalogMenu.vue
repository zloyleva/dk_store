<template>
    <div>
        <ul class="list-unstyled catalog_menu sub_menu" v-if="categories.length">
            <li v-for="category in categories" :class="{'catalog_menu-item active':category.active, 'catalog_menu-item':!category.active}" :key="category.id">
                <a class="catalog_menu-item-link d-block pl-4 py-1"
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

</style>
