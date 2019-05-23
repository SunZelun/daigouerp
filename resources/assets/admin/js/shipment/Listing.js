import AppListing from '../app-components/Listing/AppListing';

Vue.component('shipment-listing', {
    mixins: [AppListing],
    data: function () {
        return {
            orderBy: {
                column: 'updated_at',
                direction: 'desc'
            },
        }
    }
});