<template>
  <div>
    <nav class="breadcrumb">
      <ul>
        <li><a href="/">Halaman Depan</a></li>
        <li>
          <router-link :to="{ name: 'dashboard' }" append>
            Administrator
          </router-link>
        </li>
        <li>
           <router-link :to="{ name: 'listProducts' }" append>
            Produk
          </router-link>
        </li>
        <li class="is-active"><a>Tambah Produk</a></li>
      </ul>
    </nav>
    <div class="f_add_product">
      <div class="column is-one-quarter">
        <div>
          <figure class="image is-4by3">
            <img :src="generateLinkImage(product.picture_url) || 'http://bulma.io/images/placeholders/256x256.png'" class="product__image">
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
              <input type="tel" class="input"  placeholder="Barcode"
              v-model="product.barcode"
              :value="amountValue"
              @input="processValue(amountValue)"
              />
            </p>
        </div>

        <div class="field">
          <label class="label">Kategori</label>
          <p class="control">
            <span class="select">
              <select name="" v-model="product.category_id" class="select">
                <option value="">Pilih Kategori</option>
                <option :value="item.id" v-for="item in categories">{{ item.name }}</option>
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

        <div class="field">
          <label for="" class="label">Brand</label>
          <p class="control">
            <span class="select">
              <select name="" id="" class="select" v-model="product.attributes.brand">
                <option :value="item.value" v-for="item in fixtures.brand">{{ item.brand }}</option>
              </select>
            </span>
          </p>
        </div>

        <div class="field">
          <label for="" class="label">Sifat</label>
          <p class="control">
            <span class="select">
              <select name="" id="" class="select" v-model="product.attributes.sifat">
                <option :value="item.value" v-for="item in fixtures.sifat">{{ item.brand }}</option>
              </select>
            </span>
          </p>
        </div>

        <div class="field">
          <label for="" class="label">Pemakaian</label>
          <p class="control">
            <span class="select">
              <select name="" id="" class="select" v-model="product.attributes.pemakaian">
                <option :value="item.value" v-for="item in fixtures.pemakaian">{{ item.brand }}</option>
              </select>
            </span>
          </p>
        </div>

        <div class="field">
          <button class="button is-primary" @click="saveProduct($event)">Simpan</button>
        </div>

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
  .product__image {
    object-fit: scale-down;
  }
</style>

<script>
  import iziToast from 'izitoast'
  import { mapGetters, mapActions } from 'vuex'

  import brand from 'admin/json/brand.json'
  import sifat from 'admin/json/sifat.json'
  import pemakaian from 'admin/json/pemakaian.json'

  export default {
    mounted () {
      this.fixtures.brand = brand
      this.fixtures.sifat = sifat
      this.fixtures.pemakaian = pemakaian
    },
    data () {
      return {
        product: {
          'picture_url': '',
          name: '',
          description: '-',
          'category_id': '',
          barcode: '',
          attributes: {
            brand: 1,
            sifat: 1,
            pemakaian: 1
          }
        },
        onProcess: false,
        fixtures: {
          brand: null,
          sifat: null,
          pemakaian: null
        },
      }
    },
    computed: {
      ...mapGetters([
        'onError',
        'categories'
      ]),
      amountValue () {
        return this.formatToNumber(this.product.barcode)
      }
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
      saveProduct (event) {
        const data = this.product
        const a = event.target
        a.classList.add('is-loading')
        this.$http.post('api/product', data).then(response => {
          a.classList.remove('is-loading')
          iziToast.success({
              title: 'Sukses',
              message: `Produk berhasil di tambahkan`,
              position: 'bottomRight'
          })
          this.$router.push({name: 'listProducts'})
        }).catch(err => {
          this.setOnError(true)
          console.log(err)
          a.classList.remove('is-loading')
        })
        console.log('Ready to Post')
      },
      processValue(value){
        if (isNaN(value)) {
          this.product.barcode = 1
          return
        } else if (value === 0) {
          this.product.barcode = 1
        } else {
          this.product.barcode = value
        }
      },
      formatToNumber (value) {
        let number = 0
        if (this.separator === '.') {
          let cleanValue = value
          if (typeof value !== 'string') {
            cleanValue = this.numberToString(value)
          }
          number = Number(String(cleanValue).replace(/[^0-9-,]+/g, '').replace(',', '.'))
        } else {
          number = Number(String(value).replace(/[^0-9-.]+/g, ''))
        }
        if (!this.minus) return Math.abs(number)
        return number
      }
    }
  }
</script>
