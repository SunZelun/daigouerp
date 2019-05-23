import AppListing from '../app-components/Listing/AppListing';

Vue.component('customer-address-listing', {
    mixins: [AppListing],
    data: function () {
        return {
            orderBy: {
                column: 'customer_addresses.updated_at',
                direction: 'desc'
            },
        }
    }
});