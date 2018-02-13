import AppForm from '../app-components/Form/AppForm';

Vue.component('customer-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                wechat_name:  '' ,
                remarks:  '' ,
                status:  true,
                addresses: [{
                    id : '',
                    customer_id:  '' ,
                    address:  '' ,
                    contact_person:  '' ,
                    contact_number:  '' ,
                    remarks:  '' ,
                    status:  true
                }]
            }
        }
    },
    methods:{
        addRow: function() {
            this.form.addresses.push({
                customer_id:  '' ,
                address:  '' ,
                contact_person:  '' ,
                contact_number:  '' ,
                remarks:  '' ,
                status:  true
            });
        },

        delRow: function(index) {
            Vue.delete(this.form.addresses, index);
        }
    }

});