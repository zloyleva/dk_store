<template>
    <div class="container-fluid mb-3">
        <nav class="navbar navbar-expand-lg navbar-light justify-content-center">

            <button class="navbar-toggler" type="button"
                    data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                Menu <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav flex-grow-1 justify-content-center">
                    <li class="nav-item active">
                        <a class="nav-link" :href="routes.home">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :href="routes.catalog">Каталог</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :href="routes.cart">Корзина</a>
                    </li>
                </ul>
            </div>

        </nav>
    </div>
</template>

<script>
    export default {
        name: "Header",
        props:{
            routes:{

            }
        }
    }
</script>

<style scoped>

    .container-fluid{
        box-shadow: 0 1px 5px 0 rgba(0,0,0, .3),
                    0 1px 3px 0 rgba(0,0,0, .2),
                    0 2px 2px -1px rgba(0,0,0, .19);
    }

    .navbar-toggler{
        border: unset;
        outline: unset;
    }

</style>