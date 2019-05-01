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
            },
            request:{
                type: [Array, Object],
            }
        },
        methods: {

            linkGen(pageNum) {

                return pageNum === 1 ?
                    {
                        path: this.getFirstPageUrl(),
                        query: {...this.request}
                    }
                    :
                    {
                        path: location.pathname,
                        query: { page: pageNum, ...this.request }
                    }
            },

            getFirstPageUrl(){
                return location.pathname.length > 3 && location.pathname[location.pathname.length-1] === "/"?
                    location.pathname.slice(0,-1)
                    :
                    location.pathname
            }
        }
    }
</script>

<style scoped>

</style>
