import AppForm from '../app-components/Form/AppForm';

Vue.component('order-form', {
    props: ["rate"],
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
                inter_shipping_currency:  'SGD' ,
                inter_shipping_cost:  '0' ,
                dome_shipping_currency:  'RMB' ,
                dome_shipping_cost:  '0' ,
                sum_profit_in_rmb:  '' ,
                sum_profit_in_sgd:  '' ,
                remarks:  '' ,
                number_of_items_sold: 0,
                status:  '' ,
                order_status:  10,
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
        totalCostRmb() {
            this.form.cost_in_rmb = this.form.products.reduce((total, product) => {
                if (product.buying_currency == 'RMB'){
                    return total + Number(product.buying_price)*Number(product.quantity);
                } else {
                    return total;
                }
            }, 0);

            if (this.form.inter_shipping_currency == 'RMB'){
                this.form.cost_in_rmb += Number(this.form.inter_shipping_cost);
            }

            if (this.form.dome_shipping_currency == 'RMB'){
                this.form.cost_in_rmb += Number(this.form.dome_shipping_cost);
            }

            return this.form.cost_in_rmb;
        },
        totalCostSgd() {
            this.form.cost_in_sgd = this.form.products.reduce((total, product) => {
                if (product.buying_currency == 'SGD'){
                    return total + Number(product.buying_price)*Number(product.quantity);
                } else {
                    return total;
                }
            }, 0);

            if (this.form.inter_shipping_currency == 'SGD'){
                this.form.cost_in_sgd += Number(this.form.inter_shipping_cost);
            }

            if (this.form.dome_shipping_currency == 'SGD'){
                this.form.cost_in_sgd += Number(this.form.dome_shipping_cost);
            }

            return this.form.cost_in_sgd;
        },
        totalRevSgd() {
            this.form.revenue_in_sgd = this.form.products.reduce((total, product) => {
                if (product.selling_currency == 'SGD'){
                return total + Number(product.selling_price)*Number(product.quantity);
            } else {
                return total;
            }
        }, 0);
            return this.form.revenue_in_sgd;
        },
        totalRevRmb() {
            this.form.revenue_in_rmb = this.form.products.reduce((total, product) => {
                if (product.selling_currency == 'RMB'){
                return total + Number(product.selling_price)*Number(product.quantity);
            } else {
                return total;
            }
        }, 0);
            return this.form.revenue_in_rmb;
        },
        totalProfitInSgd() {
            this.form.profit_in_sgd = Number(this.form.revenue_in_sgd) - Number(this.form.cost_in_sgd);
            return this.form.profit_in_sgd;
        },
        totalProfitInRmb() {
            this.form.profit_in_rmb = Number(this.form.revenue_in_rmb) - Number(this.form.cost_in_rmb);
            return this.form.profit_in_rmb;
        },
        calcSumProfitInRmb() {
            var sum_profit = 0;
            sum_profit = Number((Number(this.form.profit_in_rmb) + Number(this.form.profit_in_sgd)*this.rate).toFixed(2));
            return sum_profit;
        },
        calcSumProfitInSgd() {
            var sum_profit = 0;
            sum_profit = Number((Number(this.form.profit_in_sgd) + Number(this.form.profit_in_rmb)/this.rate).toFixed(2));
            return sum_profit;
        },
        totalItemSold() {
            this.form.number_of_items_sold = this.form.products.reduce((total, product) => {
                return Number(total) + Number(product.quantity);
        }, 0);
            return this.form.number_of_items_sold;
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