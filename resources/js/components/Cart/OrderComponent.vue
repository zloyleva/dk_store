<template>
    <div>
        <div class="row mt-5">
            <div class="col-12">
                <h2>Оформить заказ</h2>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-12 card p-4">

                <div class="form-group">
                    <label for="address">Адрес доставки <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="address" placeholder="Введите адрес доставки">
                </div>

                <div class="form-group">
                    <label for="phone">Телефон для контакта <sup class="text-danger">*</sup></label>
                    <input type="tel" class="form-control" id="phone" placeholder="Введите телефон для контакта">
                </div>

                <div class="form-group">
                    <label for="comments">Комментарий к заказу:</label>
                    <textarea class="form-control" id="comments" rows="3"></textarea>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "OrderComponent"
    }
</script>

<style scoped>

</style>