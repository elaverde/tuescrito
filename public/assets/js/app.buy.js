app = new Vue({
    el: '#app',
    data: {
        loadingIndicator: false
    },
    created: function () {
    },
    methods: {
        submitForm: function () {
            this.store();
        },
        store:function (){
            _this = this;
            _this.loadingIndicator = true;
            axios.post(`${PATH_APP}/shoppings`, {
                product_id: document.getElementById('product_id').value,
                price: document.getElementById('price').value
            }).then(response => {
                _this.loadingIndicator = false;
                helperResponseMessage(response);
                window.location.href = '../';
            }).catch(error => {});
        }
    }
});