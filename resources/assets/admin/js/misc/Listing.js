import AppListing from '../app-components/Listing/AppListing';

Vue.component('misc-listing', {
    mixins: [AppListing],
    data: function () {
        return {
            orderBy: {
                column: 'miscs.updated_at',
                direction: 'desc'
            },
        }
    }
});