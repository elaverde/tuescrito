<template id="paginator">
  <nav v-if="pagination.last_page > 1">
    <ul class="pagination">
      <li class="page-item" v-if="pagination.prev_page_url">
        <a class="page-link" href="#" @click.prevent="goToPage(pagination.current_page - 1,pagechange)">Atrás</a>
      </li>
      <template v-for="page in pages()">
        <li class="page-item" v-if="Math.abs(pagination.current_page - page) < segment_size">
          <a class="page-link" href="#" @click.prevent="goToPage(page,pagechange)" :class="{ 'active': pagination.current_page === page }">{{ page }}</a>
        </li>
      </template>
      <li class="page-item" v-if="pagination.next_page_url">
        <a class="page-link" href="#" @click.prevent="goToPage(pagination.current_page + 1,pagechange)">Siguiente</a>
      </li>
    </ul>
  </nav>
</template>

<script>
var paginator = {
  template: '#paginator',
  props: {
    pagination: {
      type: Object,
      required: true
    },
    segment_size: {
      type: Number,
      default: 5
    },
    pagechange: {
      type: Function,
      required: true
    }
   
  },
  methods: {
    goToPage(page, callback) {
      callback(page);
    },
    pages() {
      let pages = []
      for (let i = 1; i <= this.pagination.last_page; i++) {
        pages.push(i)
      }
      return pages
    }
  }
}
</script>

