define(['uiComponent', 'jquery', 'Magento_Customer/js/customer-data'], function (Component, $, customerData) {
    "use strict";
    return Component.extend({
        initialize: function () {
            this._super();
            this.customer = customerData.get('customer');
            this.customer.subscribe(function (newValue) {
                $('#custom_fullname').text(newValue.fullname);
            });
        }
    });
});