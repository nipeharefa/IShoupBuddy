<template>
  <div class="f_add_product">
    <div class="column is-one-quarter">
      <div>
        <figure class="image is-4by3">
          <img :src="generateLinkImage(product.picture_url) || 'http://bulma.io/images/placeholders/256x256.png'">
        </figure>
        <label for="uploadFile" class="upload_label">
          <span>{{ this.product.picture_url ? "Ganti Foto Produk" : "Unggah Foto Produk"}}</span>
          <input type="file" id="uploadFile" class="input uploadFile" @change="_uploadImage">
        </label>
      </div>
    </div>
    <div class="column is-half">

      <div class="field">
        <label class="label">Nama Produk</label>
        <p class="control">
          <input type="text" class="input"  placeholder="Nama Produk" v-model="product.name"/>
        </p>
      </div>

      <div class="field">
        <label class="label">Barcode</label>
        <p class="control">
            <input type="text" class="input"  placeholder="Barcode" v-model="product.barcode"/>
          </p>
      </div>

      <div class="field">
        <label class="label">Kategori</label>
        <p class="control">
          <span class="select">
            <select name="" v-model="product.category_id" class="select">
              <option value="">Pilih Kategori</option>
              <option value="1">Uncategorized</option>
            </select>
          </span>
          </p>
      </div>

      <div class="field">
        <label class="label">Deskripsi</label>
        <p class="control">
          <textarea class="textarea" placeholder="Deskripsi produk" v-model="product.description"></textarea>
        </p>
      </div>

      <div class="field attributesSelector" v-for="item in product.attributes">
        <select name="" id="" class="input" v-model="item.id">
          <option value="">Pilih</option>
          <option :value="item.id" v-for="item in attributeRule">{{ item.value }}</option>
        </select>
        <input type="text" class="input" v-model="item.value">
      </div>

      <div class="field">
        <a @click="addAttribute">
          <i class="fa fa-plus"></i>
        </a>
      </div>

      <div class="field">
        <button class="button is-primary" @click="saveProduct">Simpan</button>
      </div>

    </div>
  </div>
</template>

<style lang="scss" scoped>
  @import "~sassPages/admin/product/create";
  .attributesSelector {
    display: flex;
    flex-direction: row;
    select, input {
      font-size: 0.85rem;
    }
  }
</style>

<script>
  import { mapGetters, mapActions } from 'vuex'

  export default {
    data () {
      return {
        product: {
          'picture_url': '',
          name: '',
          description: '-',
          'category_id': '',
          barcode: '',
          attributes: [
            {
              id: '',
              value: ''
            }
          ]
        },
        onProcess: false,
        attributeRule: [
          {
            'id': 1,
            'value': 'Kapasitas (ml)'
          },
          {
            'id': 2,
            'value': 'Input Voltage (v)'
          }
        ]
      }
    },
    computed: {
      ...mapGetters([
        'onError'
      ])
    },
    methods: {
      ...mapActions([
        'setOnError'
      ]),
      addAttribute () {},
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
          this.product.picture_url = response.data.image
        }).catch(error => {
          return error
        })

        console.log(fileName)
      },
      saveProduct () {
        const data = this.product
        this.$http.post('api/product', data).then(response => {
          console.log(response.data)
          window.location.assign('/admin/product')
        }).catch(err => {
          this.setOnError(true)
          console.log(err)
        })
        console.log('Ready to Post')
      }
    }
  }
</script>
