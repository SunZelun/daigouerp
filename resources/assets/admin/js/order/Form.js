import AppForm from '../app-components/Form/AppForm';

Vue.component('order-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                customer_id:  '' ,
                customer_address_id:  '' ,
                cost_in_rmb:  '' ,
                cost_in_sgd:  '' ,
                revenue_in_rmb:  '' ,
                revenue_in_sgd:  '' ,
                profit_in_rmb:  '' ,
                profit_in_sgd:  '' ,
                remarks:  '' ,
                status:  '' ,
                products: [{
                    detail: '',
                    quantity: '',
                    buying_currency: 'SGD',
                    buying_price: '',
                    selling_currency: 'RMB',
                    selling_price: '',
                    remarks: ''
                }]
            }
        }
    },
    computed: {
        // subtotalRow() {
        //     return this.items.map((item) => {
        //         return Number(item.qty * item.price)
        //     });
        // },
        totalRmb() {
            return this.form.products.reduce((total, product) => {
                if (product.buying_currency == 'RMB'){
                    return total + product.buying_price;
                }
            }, 0);
        },
        totalSgd() {
            return this.form.products.reduce((total, product) => {
                if (product.buying_currency == 'SGD'){
                    return total + product.buying_price;
                }
            }, 0);
        }
    },
    methods:{
        addRow: function() {
            this.form.products.push({
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
            Vue.delete(this.form.products, index);
        },

        pushFields: function() {
            //this.form.products = this.products;
        },
        nameOnly: function ({ name }) {
            return `${name}`
        }
    }

});