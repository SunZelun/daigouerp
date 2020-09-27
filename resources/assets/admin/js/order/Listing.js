import AppListing from '../app-components/Listing/AppListing';

Vue.component('order-listing', {
    mixins: [AppListing],
    data: function () {
        return {
            orderBy: {
                column: 'orders.updated_at',
                direction: 'desc'
            },
        }
    }
});