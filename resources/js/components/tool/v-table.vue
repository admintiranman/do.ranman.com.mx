<template>
  <section>

      <b-field horizontal label="Numero de registros por pagina" v-if="v_data.length >= 10">    
        <b-select v-model="sizePage">
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option :value="v_data.length">Todos</option>
        </b-select>
        <a v-if="can_export" target="_blank" :href="url_export" class="button is-success">
          <span class="icon">
            <i class="fa fa-file-excel"></i>
          </span>
          <span>
            Exportar
          </span>
        </a>
      </b-field>

    <b-table
      :data="v_data"
      :paginated="v_data.length > sizePage"
      :per-page="sizePage"
      :pagination-simple="isPaginationSimple"
      :pagination-position="paginationPosition"
      :sort-icon="sortIcon"
      :sort-icon-size="sortIconSize"
      :default-sort-direction="defaultPaginationOrder"
      :current-page.sync="currentPage"
      aria-next-label="Next page"
      aria-previous-label="Previous page"
      aria-page-label="Page"
      aria-current-label="Current page"
      bordered      
    >
      <slot></slot>
      <template #empty>
        <div class="has-text-centered">
          {{ text_empty }}
        </div>
      </template>
    </b-table>
  </section>
</template>

<script>
export default {
  props: ["v_columns", "v_data", "v_size_page", "v_class", "t_empty",  "can_export", "url_export" ], //  
  data() {
        
    return {
      isPaginated: true,
      isPaginationSimple: false,
      paginationPosition: "bottom",
      sortIcon: "arrow-up",
      sortIconSize: "is-small",
      defaultPaginationOrder: "asc",
      sizePage: this.v_size_page || 15,
      currentPage: 1,
      text_empty: this.t_empty || "Sin Datos.",
    };
  },
};
</script>



