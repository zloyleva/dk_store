import axios from 'axios';

const state = {
    items: [],
    checkoutStatus: null,
    count: null,
    total: null,
    routes: {},
};

const actions = {
    pushProductToCart (context, product) {
        console.log("pushProductToCart",product, context.state.routes.addToCart);

        axios.post(context.state.routes.addToCart,{
            product_id: product.id
        })
            .then(res => {
                console.log(res)
            })
    },
};

const mutations = {
    setRoutes(state, payload) {
        state.routes = {...state.routes, ...payload}
    }
};


export default {
    namespaced: true,
    state,
    // getters,
    actions,
    mutations
}
