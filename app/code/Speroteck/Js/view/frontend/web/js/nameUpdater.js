define(['uiComponent', 'ko', 'Magento_Customer/js/customer-data'], function (Component, ko, customerData) {
    "use strict";

    return Component.extend({
        initialize: function () {
            var self = this;
            this._super();
            self.customer = customerData.get('customer');
            window.setInterval(function () {
                var selectFruit = ["John", "Adam", "Mike", "Patric", "Rayan", "Oliver"];
                self.customer({fullname: selectFruit[Math.floor(Math.random() * 6)]});
            }, 1000);
        }
    });
});
