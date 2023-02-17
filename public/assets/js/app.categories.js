app = new Vue({
    el: '#app',
    data: {
        id:'',
        name:'',
        description:'',
        categories:[],
        isEditing: false,
        loadingIndicator: false,
        loadingSpinner: false
    },
    created: function () {
        this.getCategories();
    },
    methods: {
        clearInputs: function () {
            this.name = '';
            this.description = '';
            this.isEditing = false;
            this.getCategories();
        },
        editCategory: function (data) {
            this.isEditing = true;
            this.id = data.id;
            this.name = data.name;
            this.description = data.description;
        },
        submitForm: function () {
            this.isEditing ? this.updateCategory() : this.storeCategory();
        },
        storeCategory: function () {
            this.loadingIndicator = true;
            axios.post(`${PATH_APP}/category`, {
                name: this.name,
                description: this.description
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
        updateCategory: function () {
            this.loadingIndicator = true;
            axios.put(`${PATH_APP}/category/${this.id}`, {
                name: this.name,
                description: this.description
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
        deleteCategory: function (id) {
            Swal.fire({
                title: "¿Esta seguro?",
                text: "¡No podras recuperar la información!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDeleted) => {
                if (willDeleted) {
                    this.loadingSpinner = true;
                    axios.delete(`${PATH_APP}/category/${id}`)
                    .then(response => {
                        this.getCategories();
                        helperResponseMessage(response);
                    })
                    .catch(function (error)  {
                        helperResponseMessage(error.response);
                    });
                }
            });
        },
        getCategories: function () {
            this.loadingSpinner = true;
            axios.get(`${PATH_APP}/categories`)
            .then(response => {
                this.categories = response.data.categories;
                this.loadingSpinner = false;
            })
            .catch(function (error)  {
                this.loadingSpinner = false;
            });
        },
    }
});