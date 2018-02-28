import AppForm from '../app-components/Form/AppForm';

Vue.component('shipment-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                ship_date:  '' ,
                type:  1 ,
                logistic_company_name:  '' ,
                tracking_number:  '' ,
                logistic_status:  '' ,
                cost_currency:  'SGD' ,
                cost:  0,
                remarks:  '' ,
                shipment_status:  10 ,
                status:  1 ,
                order_ids : [],
                orders : [],
                type_text : '',
                shipment_status_text : '',
            },
        }
    },
    props: ['oorders', 'dorders', 'options'],
    methods:{
        orderDisplay: function ({ remarks, customer, order_date, products }) {
            var labelDisplay = "-";
            if (customer != undefined){
                labelDisplay = `${customer.name}` + ' (' + `${customer.wechat_name}` + ')'
                if (remarks != null && remarks != undefined){
                    labelDisplay += ' - ' + `${remarks}`
                }

                // if (order_date != null && order_date != undefined){
                //     labelDisplay += ' - ' + `${order_date}`
                // }
            }

            if (products != undefined){
                var productString = '\n\r ';
                for (var i = 0; i < products.length; i++) {
                    var productName = products[i].detail.name;

                    if (products[i].detail.brand != null && products[i].detail.brand != undefined){
                        productName = products[i].detail.brand.name + productName;
                    }

                    productString += productName + '/';
                }
            }

            labelDisplay += ' ' +productString;
            return labelDisplay;
        },
        updateOrders: function (value) {
            this.form.order_ids.push(value.id)
        },
        removeOrder: function (value) {
            var index = this.form.order_ids.indexOf(value.id);
            if (index !== -1) this.form.order_ids.splice(index, 1);
        },
        updateOptions: function (value) {
            if (value.target.value == 1) {
                this.options = this.oorders
            } else {
                this.options = this.dorders
            }
            this.form.orders = [];
            this.form.order_ids = [];
        },
    }
});