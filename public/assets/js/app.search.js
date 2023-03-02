app = new Vue({
    el: '#app',
    data: {
        category:{
            id:'1',
            name:'Todas las categorias'
        },
        products:[],
        loadingSpinner: false
    },
    created: function () {
        this.getProductText();
    },
    methods: {
        changeCategory:function(id, name){
            this.category.id = id;
            this.category.name = name;
            this.getProductText();
        },
        getProductText: function () {
            this.loadingSpinner = true;
            axios.get(`${PATH_APP}/getTextbyCategory/${this.category.id}`)
                .then(response => {
                    this.products = response.data.products;
                    this.loadingSpinner = false;
                })
                .catch(error => {
                    console.log(error);
                }
            );
        }
    }
});