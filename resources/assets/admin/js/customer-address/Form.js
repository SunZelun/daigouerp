import AppForm from '../app-components/Form/AppForm';

Vue.component('customer-address-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                customer: '',
                customer_id:  '' ,
                address:  '' ,
                contact_person:  '' ,
                contact_number:  '' ,
                remarks:  '' ,
                status:  false ,
                
            }
        }
    },
    methods:{
        nameOnly: function ({ name }) {
            return `${name}`
        },
        updateSelectedCustomer: function (value) {
            if (value != null) {
                this.form.customer_id = value.id;
            } else {
                this.form.customer_id = null;
            }
        },
    }
});