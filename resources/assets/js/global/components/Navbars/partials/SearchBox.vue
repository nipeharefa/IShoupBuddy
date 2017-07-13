<template>
  <div class="nav-center is-hidden-touch">
    <a class="nav-item">
      <div class="field has-addons">
        <p class="control akumaubelanja">
          <input class="input" type="text" placeholder="Cari produk" role="search" v-model="q"
            @keyup.enter="search">
        </p>
        <p class="control">
          <div class="select">
            <select v-model="category_id">
              <option value="">Semua Kategori</option>
              <option :value="item.id" v-for="item in sortedCategory">{{ item.name }}</option>
            </select>
          </div>
        </p>
        <p class="control">
          <a class="button" @click="search">
            <i class="fa fa-search"></i>
          </a>
        </p>
      </div>
    </a>
  </div>
</template>


<style scoped>
  .fa-search {
    font-size: 15px;
  }
</style>

<script>
  export default {
    created () {
      this.getCategory()
    },
    data () {
      return {
        q: '',
        category: null,
        category_id: ""
      }
    },
    computed: {
      sortedCategory () {
        if (this.category) {
          return this.category.sort( (a,b) => {
            var nameA = a.name.toUpperCase(); // ignore upper and lowercase
            var nameB = b.name.toUpperCase(); // ignore upper and lowercase
            if (nameA < nameB) {
              return -1;
            }
            if (nameA > nameB) {
              return 1;
            }

            // names must be equal
            return 0;
          })
        }
        return []
      }
    },
    methods: {
      search () {
        window.location.assign(`/search?q=${this.q}&category_id=${this.category_id}`)
      },
      getCategory () {
        this.$http.get('api/category').then(response => {
          this.category = response.data.categories
        })
      }
    }
  }
</script>
