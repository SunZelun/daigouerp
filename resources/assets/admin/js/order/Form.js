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
                products:[]
            },
            products:[{
                product_id: '',
                quantity: '',
                buying_currency: '',
                buying_price: '',
                selling_currency: '',
                selling_price: '',
                remarks: ''
            }]
        }
    },
    methods:{
        addRow: function() {
            this.products.push({
                product_id: '',
                quantity: '',
                buying_currency: '',
                buying_price: '',
                selling_currency: '',
                selling_price: '',
                remarks: ''
            });
        },

        delRow: function(item) {
            console.log(item);
            console.log(this.products);
            let ind = this.products.indexOf(item);
            this.products.splice(ind, 1);
        },

        pushFields: function()
        {
            this.form.products = [];
            this.form.products.push(
                this.products
            );
        }
    }

});