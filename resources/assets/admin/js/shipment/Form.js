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
                orders : []
            }
        }
    },
    methods:{
        orderDisplay: function ({ remarks, customer }) {
            var labelDisplay = `${customer.name}` + ' (' + `${customer.wechat_name}` + ')'
            if (remarks != null || remarks != undefined){
                labelDisplay += ' - ' + `${remarks}`
            }

            return labelDisplay;
        }
    }
});