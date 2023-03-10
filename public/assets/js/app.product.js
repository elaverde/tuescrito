app = new Vue({
    el: '#app',
    data: {
        id:'',
        name:'',
        price: '',
        description:'',
        id_category:'',
        category_id:'',
        products:[],
        categories:[],
        isEditing: false,
        loadingIndicator: false,
        loadingSpinner: false
    },
    created: function () {
        this.getCategories();
        this.getProducts();
    },
    methods: {
        clearInputs: function () {
            this.name = '';
            this.description = '';
            this.price = '';
            this.isEditing = false;
            this.getProducts();
        },
        editProduct: function (data) {
            this.isEditing = true;
            this.id = data.id;
            this.name = data.name;
            this.price = data.price;
            this.description = data.description;
            this.category_id = data.category_id;
        },
        submitForm: function () {
            this.isEditing ? this.updateProduct() : this.storeProduct();
        },
        storeProduct: function () {
            this.loadingIndicator = true;
            axios.post(`${PATH_APP}/product`, {
                name: this.name,
                price: this.price,
                description: this.description,
                category_id: this.category_id
            })
            .then(response => {
                this.loadingIndicator = false;
                this.clearInputs();
                helperResponseMessage(response);
            })
            .catch(function (error)  {
                this.loadingIndicator = false;
                helperResponseMessage(error.response);
            });
        },
        updateProduct: function () {
            this.loadingIndicator = true;
            axios.put(`${PATH_APP}/product/${this.id}`, {
                name: this.name,
                price: this.price,
                description: this.description,
                id_category: this.id_category
            })
            .then(response => {
                this.loadingIndicator = false;
                this.clearInputs();
                helperResponseMessage(response);
            })
            .catch(function (error)  {
                this.loadingIndicator = false;
                helperResponseMessage(error.response);
            });
        },
        deleteProduct: function (id) {
            Swal.fire({
                title: "??Esta seguro?",
                text: "??No podras recuperar la informaci??n!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDeleted) => {
                if (willDeleted) {
                    this.loadingSpinner = true;
                    axios.delete(`${PATH_APP}/product/${id}`)
                    .then(response => {
                        this.getProducts();
                        helperResponseMessage(response);
                        this.loadingSpinner = false;
                    })
                    .catch(function (error)  {
                        helperResponseMessage(error.response);
                        this.loadingSpinner = false;
                    });
                }
            });
        },
        getProducts: function () {
            this.loadingSpinner = true;
            axios.get(`${PATH_APP}/products`)
            .then(response => {
                this.products = response.data.products;
                this.loadingSpinner = false;
            })
            .catch(function (error)  {
                this.loadingSpinner = false;
            });
        },
        getCategories: function () {
            axios.get(`${PATH_APP}/categories`)
            .then(response => {
                this.categories = response.data.categories;
                this.id_category = this.categories[0].id;
            })
            .catch(function (error)  {
            });
        }
    }
});