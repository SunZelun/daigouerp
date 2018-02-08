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
        totalCostRmb() {
            this.form.cost_in_rmb = this.form.products.reduce((total, product) => {
                if (product.buying_currency == 'RMB'){
                    return total + Number(product.buying_price);
                } else {
                    return total;
                }
            }, 0);
            return this.form.cost_in_rmb;
        },
        totalCostSgd() {
            this.form.cost_in_sgd = this.form.products.reduce((total, product) => {
                if (product.buying_currency == 'SGD'){
                    return total + Number(product.buying_price);
                } else {
                    return total;
                }
                console.log(total);
            }, 0);

            return this.form.cost_in_sgd;
        },
        totalRevSgd() {
            this.form.revenue_in_sgd = this.form.products.reduce((total, product) => {
                if (product.selling_currency == 'SGD'){
                return total + Number(product.selling_price);
            } else {
                return total;
            }
        }, 0);
            return this.form.revenue_in_sgd;
        },
        totalRevRmb() {
            this.form.revenue_in_rmb = this.form.products.reduce((total, product) => {
                if (product.selling_currency == 'RMB'){
                return total + Number(product.selling_price);
            } else {
                return total;
            }
        }, 0);
            return this.form.revenue_in_rmb;
        },
        totalProfitSgd() {
            this.form.profit_in_sgd = Number(this.form.revenue_in_sgd) - Number(this.form.cost_in_sgd);
            return this.form.profit_in_sgd;
        },
        totalProfitRmb() {
            this.form.profit_in_rmb = Number(this.form.revenue_in_rmb) - Number(this.form.cost_in_rmb);
            return this.form.profit_in_rmb;
        },
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