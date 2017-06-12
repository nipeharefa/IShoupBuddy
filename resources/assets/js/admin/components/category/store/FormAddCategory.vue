<template>
  <div class="f_add_product">
    <div class="column is-half">
      <div class="field">
        <label class="label">Nama Kategori</label>
        <p class="control">
          <input type="text" class="input"  placeholder="Nama Kategori" v-model="category.name"/>
        </p>
      </div>

      <div class="field">
        <a class="button is-primary" @click="saveCategory">Simpan</a>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        category: {
          name: ''
        }
      }
    },
    methods: {
      saveCategory () {
        const data = this.category
        this.$http.post('api/admin/category', data).then(response => {
          console.log(response.data)
        })
      }
    }
  }
</script>
