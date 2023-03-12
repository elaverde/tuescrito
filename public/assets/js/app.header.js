var app = new Vue({
    el: '#header',
    data: {
       notifications:0,
       buys:[]

    },
    created: function () {
        this.getNotifications();
    },
    methods: {
        setViewed: function () {
            axios.post(`${PATH_APP}/shoppings/notifications`)
            .then(response => {
                this.notifications = 0;
            })
            .catch(function (error)  {
                
            });
        },
        getNotifications: function () {
            axios.get(`${PATH_APP}/shoppings/resumen`)
            .then(response => {
                this.notifications = response.data.count;
                this.buys = response.data.buys;
            })
            .catch(function (error)  {
                
            });
        }
    },
    filters: {
        formatMoneda(value) {
        const formatter = new Intl.NumberFormat('es-CO', {
            style: 'currency',
            currency: 'COP'
        })
        return formatter.format(value)
        }
    }
});