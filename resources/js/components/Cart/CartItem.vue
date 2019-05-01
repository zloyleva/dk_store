<template>

    <tr>
        <th scope="row">{{ i + 1 }}</th>
        <td>{{ cartItem.product.name }}</td>
        <td>{{ cartItem.product.price_user }}</td>
        <td>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary" type="button" @click="subItemCount">
                        <font-awesome-icon icon="minus" />
                    </button>
                </div>
                <input type="text" class="form-control" placeholder=""
                       v-model="cartItem.count" @input="inputItemCount">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" @click="addItemCount">
                        <font-awesome-icon icon="plus" />
                    </button>
                </div>
            </div>
        </td>
        <td>@mdo</td>
    </tr>

</template>

<script>
    export default {
        name: "CartItem",
        props:{
            item:{

            },
            i:{

            }
        },
        data(){
            return {
                cartItem:{},
                debounceHandler: null,
            }
        },
        created(){
            this.cartItem = {...this.item};

            this.debounceHandler =   _.debounce(()=>{
                console.log("debounce");



            }, 1000,{leading:false, trailing:true});
        },
        methods:{
            addItemCount(){
                console.log("addItemCount");
                this.cartItem.count++;
                this.debounceHandler();
            },
            subItemCount(){
                console.log("subItemCount")
                if(this.cartItem.count > 0){
                    this.cartItem.count--;
                    this.debounceHandler();
                }
            },
            inputItemCount() {
                console.log("inputItemCount",this.cartItem.count);

                const value = parseFloat(this.cartItem.count).toFixed();
                this.cartItem.count = isNaN(value)?0:value;
                this.debounceHandler();
            }
        },
        filters:{
            onlyNumbers(value){
                console.log("onlyNumbers");
                return value;
            }
        }
    }
</script>

<style scoped>

</style>
