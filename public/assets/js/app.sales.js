/* Una instancia de Vue.js. */

var app = new Vue({
  el: "#app",
  data: {
    notifications: 0,
    buys: [],
    parameters: [],
    texts: [{ title: "Cargando...", description: "Espere un momento.." }],
    template: "",
    products: [],
    sale: {},
    loadingSpinner: true,
  },
  created: function () {
    this.getSales();
    this.getProducts();
    
  },
  methods: {
    getSales: function () {
      this.loadingSpinner = true;
      axios
        .get(`${PATH_APP}/shoppings/nodispatch`)
        .then((response) => {
            this.loadingSpinner = false;
            this.notifications = response.data.count;
            this.buys = response.data.buys;
        })
        .catch(function (error) {});
    },
    clearTemplates: function () {
        this.template = "";
        this.parameters = [];
    },
    setTemplate: function (template) {
      this.template = template.template;
      this.parameters = template.parameters;
    },
    setSale(sale) {
      this.sale = sale;
      this.clearTemplates();
      this.getText(sale.purchase_details[0].product_id);
    },
    getText(id) {
      this.clearTemplates();
      let endpoint = `${PATH_APP}/getTextbyProduct/${id}`;
      this.texts= [{ title: "Cargando...", description: "Espere un momento.." }];
      axios
        .get(endpoint)
        .then((response) => {
          this.texts = response.data.texts;
        })
        .catch(function (error) {});
    },
    getProducts: function () {
        
        axios
            .get(`${PATH_APP}/products`)
            .then((response) => {
                this.products = response.data.products;
                console.log(this.products);
            })
            .catch(function (error) {});
    }
  },
  filters: {
    formatMoneda(value) {
      const formatter = new Intl.NumberFormat("es-CO", {
        style: "currency",
        currency: "COP",
      });
      return formatter.format(value);
    },
  },
});
