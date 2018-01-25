import AppForm from '../app-components/Form/AppForm';

Vue.component('customer-address-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                customer_id:  '' ,
                address:  '' ,
                contact_person:  '' ,
                contact_number:  '' ,
                remarks:  '' ,
                status:  false ,
                
            }
        }
    }

});