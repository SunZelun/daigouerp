import AppForm from '../app-components/Form/AppForm';

Vue.component('product-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                description:  '' ,
                selling_price_rmb:  '' ,
                selling_price_sgd:  '' ,
                buying_price_rmb:  '' ,
                buying_price_sgd:  '' ,
                remarks:  '' ,
                status:  '' ,
                
            }
        }
    }

});