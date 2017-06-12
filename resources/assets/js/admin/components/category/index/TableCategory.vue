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
      <tr v-for="item in categories">
        <td>{{ item.id }}</td>
        <td>{{ item.name }}</td>
        <td>{{ item.slug }}</td>
        <td>
          <a class="button is-small is-primary">Edit</a>
        </td>
      </tr>
    </tbody>
  </table>
</template>


<script>

  import { mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters([
        'categories'
      ])
    }
  }
</script>
