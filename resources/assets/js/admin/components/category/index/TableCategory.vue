<template>
  <table class="table">
    <thead>
      <tr>
        <th></th>
        <th>Nama Produk</th>
        <th>Slug</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in categories">
        <td>{{ item.id }}</td>
        <td>{{ item.name }}</td>
        <td>{{ item.slug }}</td>
        <td>
          <a class="button is-small is-primary">Edit</a>
          <a class="button is-small is-danger" @click="deleteC(item, index, $event)">Hapus</a>
        </td>
      </tr>
    </tbody>
  </table>
</template>


<script>

  import { mapGetters, mapActions } from 'vuex'

  export default {
    computed: {
      ...mapGetters([
        'categories'
      ])
    },
    methods: {
      ...mapActions(['deleteCategory']),
      deleteC (item, index, event) {
        const a = event.target
        const id = item.id
        a.classList.add('is-loading')

        this.$http.delete(`api/admin/category/${id}`).then(response => {
          a.classList.remove('is-loading')
          this.deleteCategory(index)
        }).catch(err => {
          a.classList.remove('is-loading')
        })
      }
    }
  }
</script>
