import AppForm from '../app-components/Form/AppForm';

Vue.component('order-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
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
                products: []
            },
            products:[{
                detail: '',
                quantity: '',
                buying_currency: 'SGD',
                buying_price: '',
                selling_currency: 'RMB',
                selling_price: '',
                remarks: ''
            }]
        }
    },
    methods:{
        addRow: function() {
            this.products.push({
                detail: '',
                quantity: '',
                buying_currency: 'SGD',
                buying_price: '',
                selling_currency: 'RMB',
                selling_price: '',
                remarks: ''
            });
        },

        delRow: function(index) {
            Vue.delete(this.products, index);
        },

        pushFields: function() {
            this.form.products = this.products;
        },
        nameOnly: function ({ name }) {
            return `${name}`
        }
    }

});