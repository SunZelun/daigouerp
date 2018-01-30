import AppForm from '../app-components/Form/AppForm';

Vue.component('order-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                user_id:  '' ,
                customer_id:  '' ,
                customer_address_id:  '' ,
                cost_currency:  '' ,
                total_cost:  '' ,
                amount_currency:  '' ,
                total_amount:  '' ,
                profit_currency:  '' ,
                total_profit:  '' ,
                remarks:  '' ,
                status:  '' ,
                
            }
        }
    }

});