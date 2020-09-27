import AppForm from '../app-components/Form/AppForm';

Vue.component('sys-code-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                code:  '' ,
                type:  'brand' ,
                name:  '' ,
                status:  true ,
                
            }
        }
    }

});