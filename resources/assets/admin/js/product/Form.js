import AppForm from '../app-components/Form/AppForm';

Vue.component('product-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                description:  '' ,
                selling_price_rmb:  '' ,
                selling_price_sgd:  '' ,
                buying_price_rmb:  '' ,
                buying_price_sgd:  '' ,
                category_id:  '' ,
                category:  '' ,
                brand_id:  '' ,
                brand:  '' ,
                remarks:  '' ,
                status:  '' ,
                quantity:  ''
            }
        }
    },
    methods:{
        nameOnly: function ({ name }) {
            return `${name}`
        },
        updateSelectedCategory: function (value) {
            this.form.category_id = value.id
        },
        updateSelectedBrand: function (value) {
            this.form.brand_id = value.id
        },
    }
});