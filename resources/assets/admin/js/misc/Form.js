import AppForm from '../app-components/Form/AppForm';

Vue.component('misc-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                type:  1 ,
                date:  '' ,
                cost_in_rmb:  '' ,
                cost_in_sgd:  '' ,
                income_in_rmb:  '' ,
                income_in_sgd:  '' ,
                remarks:  '' ,
                status:  true ,
                
            }
        }
    }

});