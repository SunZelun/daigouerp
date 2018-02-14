import AppForm from '../app-components/Form/AppForm';

Vue.component('shipment-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                ship_date:  '' ,
                type:  '' ,
                logistic_company_name:  '' ,
                tracking_number:  '' ,
                logistic_status:  '' ,
                cost_currency:  '' ,
                cost:  '' ,
                remarks:  '' ,
                shipment_status:  '' ,
                status:  '' ,
                
            }
        }
    }

});