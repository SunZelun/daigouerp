import AppListing from '../app-components/Listing/AppListing';

Vue.component('product-listing', {
    mixins: [AppListing],
    data: function () {
        return {
            orderBy: {
                column: 'products.updated_at',
                direction: 'desc'
            },
        }
    }
});