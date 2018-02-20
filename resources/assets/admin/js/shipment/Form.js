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
                orders : []
            },
        }
    },
    props: ['oorders', 'dorders', 'options'],
    methods:{
        orderDisplay: function ({ remarks, customer }) {
            var labelDisplay = `${customer.name}` + ' (' + `${customer.wechat_name}` + ')'
            if (remarks != null || remarks != undefined){
                labelDisplay += ' - ' + `${remarks}`
            }

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
            this.form.orders.length = 0;
            this.form.order_ids.length = 0;

            console.log(this.form.orders);
            console.log(this.form.order_ids);
        },
    }
});