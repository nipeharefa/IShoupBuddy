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
              <option :value="item.id" v-for="item in categories">{{ item.name }}</option>
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
          <label for="" class="label">Brand</label>
          <p class="control">
            <span class="select">
              <select name="" id="" class="select" v-model="edit.attributes.brand">
                <option :value="item.value" v-for="item in fixtures.brand">{{ item.brand }}</option>
              </select>
            </span>
          </p>
        </div>

        <div class="field">
          <label for="" class="label">Sifat</label>
          <p class="control">
            <span class="select">
              <select name="" id="" class="select" v-model="edit.attributes.sifat">
                <option :value="item.value" v-for="item in fixtures.sifat">{{ item.brand }}</option>
              </select>
            </span>
          </p>
        </div>

      <div class="field">
          <label for="" class="label">Pemakaian</label>
          <p class="control">
            <span class="select">
              <select name="" id="" class="select" v-model="edit.attributes.pemakaian">
                <option :value="item.value" v-for="item in fixtures.pemakaian">{{ item.brand }}</option>
              </select>
            </span>
          </p>
        </div>

      <div class="field">
        <button class="button is-primary" @click="updateDataProduct">Simpan</button>
      </div>

    </div>
  </div>
</template>

<style lang="scss" scoped>
  @import "~sassPages/admin/product/edit";
  img {
    object-fit: scale-down;
  }
</style>

<script>
  import { alert } from 'notie'
  const path = require('path')
  import iziToast from 'izitoast'
  import { mapGetters, mapActions } from 'vuex'

  import brand from 'admin/json/brand.json'
  import sifat from 'admin/json/sifat.json'
  import pemakaian from 'admin/json/pemakaian.json'

  export default {
    mounted () {
      this.originalImage = path.basename(this.edit.picture_url.medium)
      this.fixtures.brand = brand
      this.fixtures.sifat = sifat
      this.fixtures.pemakaian = pemakaian
    },
    data () {
      return {
        originalImage: '',
        edit: this.$store.state.product,
        fixtures: {
          brand: null,
          sifat: null,
          pemakaian: null
        }
      }
    },
    computed: {
      ...mapGetters([
        'products',
        'categories'
      ])
    },
    methods: {
      ...mapActions(['updateProduct']),
      updateDataProduct () {
        const data = {
          id: this.edit.id,
          'picture_url': this.originalImage,
          name: this.edit.name,
          description: this.edit.description,
          'category_id': this.edit.category.id,
          barcode: this.edit.barcode,
          attributes: this.edit.attributes
        }
        const idProduct = data.id
        this.$http.put('api/product/' + data.id, data).then(response => {
          const indexProduct = this.products.findIndex( x => idProduct === x.id)
          const data = {
            index: indexProduct,
            product: response.data.product
          }
          this.updateProduct(data)
          iziToast.success({
              title: 'Sukses',
              message: `Data Produk berhasil diperbaharui`,
              position: 'bottomRight'
          })
          this.$router.push({name: 'listProducts'})
        }).catch(err => {
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
