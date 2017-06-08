<template>
  <div class="f_edit_product" v-if="edit">
    <div class="column is-one-quarter">
      <div>
        <figure class="image is-4by3">
          <img :src="generateLinkImage(originalImage)">
        </figure>
        <label for="uploadFile" class="upload_label">
          <span>{{ originalImage ? "Ganti Foto Produk" : "Unggah Foto Produk"}}</span>
          <input type="file" id="uploadFile" class="input uploadFile" @change="_uploadImage">
        </label>
      </div>
    </div>
    <div class="column is-half">

      <div class="field">
        <label class="label">Nama Produk</label>
        <p class="control">
          <input type="text" class="input"  placeholder="Nama Produk" v-model="edit.name"/>
        </p>
      </div>

      <div class="field">
        <label class="label">Barcode</label>
        <p class="control">
            <input type="text" class="input"  placeholder="Barcode" v-model="edit.barcode"/>
          </p>
      </div>

      <div class="field">
        <label class="label">Kategori</label>
        <p class="control">
          <span class="select">
            <select name="" v-model="edit.category.id" class="select">
              <option value="">Pilih Kategori</option>
              <option value="1">Uncategorized</option>
            </select>
          </span>
          </p>
      </div>

      <div class="field">
        <label class="label">Deskripsi</label>
        <p class="control">
          <textarea class="textarea" placeholder="Deskripsi produk" v-model="edit.description"></textarea>
        </p>
      </div>

      <div class="field">
        <button class="button is-primary" @click="updateProduct">Simpan</button>
      </div>

    </div>
  </div>
</template>

<style lang="scss" scoped>
  @import "~sassPages/admin/product/edit";
</style>

<script>
  import { alert } from 'notie'

  const path = require('path')

  export default {
    mounted () {
      this.originalImage = path.basename(this.edit.picture_url.medium)
    },
    data () {
      return {
        originalImage: '',
        edit: this.$store.state.product
      }
    },
    methods: {
      _showNotif () {
        console.log('asdfsad')
        alert({
          type: 1,
          text: 'Data produk berhasil diperbaharui'
        })
      },
      updateProduct () {
        const data = {
          id: this.edit.id,
          'picture_url': this.edit.originalImage,
          name: this.edit.name,
          description: this.edit.description,
          'category_id': this.edit.category.id,
          barcode: this.edit.barcode
        }
        this.$http.put('api/product/' + data.id, data).then(response => {
          console.log(response.data)
          this._showNotif()
        }).catch(err => {
          this.setOnError(true)
          console.log(err)
        })
      },
      generateLinkImage (filename) {
        if (filename) {
          return window.location.origin + '/image/small/' + filename
        }
      },
      _uploadImage (e) {
        const file = e.target.files[0]
        const fileName = file.name.toLowerCase()

        if (!(file && fileName.match(/\.(jpg|jpeg|png|gif)$/))) {
          alert('Picture format not supported')
          return
        }

        if (file.size > 3000000) {
          alert('Picture is too large (max 3MB)')
          return
        }

        const formData = new FormData()
        formData.append('image', file)

        this.$http.post('api/image', formData).then(response => {
          console.log(response)
          this.originalImage = response.data.image
        }).catch(error => {
          return error
        })
      }
    }
  }
</script>
