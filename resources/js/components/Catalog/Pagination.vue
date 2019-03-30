<template>
    <div class="row">
        <div class="overflow-auto">
            <b-pagination-nav :link-gen="linkGen" :number-of-pages="last_page" use-router></b-pagination-nav>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Pagination",
        props:{
            last_page:{
                type: Number
            }
        },
        methods: {
            linkGen(pageNum) {
                return pageNum === 1 ? '?' : `?page=${pageNum}`
            }
        }
    }
</script>

<style scoped>

</style>
