<template>
  <div class="box-form">
   <div class="column is-one-quarter">
    <div>
      <figure class="image is-4by3">
        <img :src="generateLinkImage(product.picture_url) || 'http://bulma.io/images/placeholders/256x256.png'">
      </figure>
      <label for="inputPhoto">
          <a class="is-link">Upload Gambar</a>
        </label>
      <input type="file" id="inputPhoto" class="input" @change="_uploadImage" style="display:none;">
    </div>
  </div>

  <div class="column is-half">

    <div class="form-product">
      <div class="field">
        <label class="label">Nama Produk</label>
        <p class="control">
          <input type="text" class="input"  placeholder="Nama Produk" v-model="product.name"/>
        </p>
      </div>
      <div class="field">
        <label class="label">Barcode</label>
        <p class="control">
          <input type="text" class="input"  placeholder="Barcode" v-model="product.barcode" />
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
        <label class="label">Harga</label>
        <p class="control">
          <input type="text" class="input" placeholder="Harga" v-model="product.price"/>
        </p>
      </div>
      <div class="field">
        <label class="label">Deskripsi</label>
        <p class="control">
          <textarea class="textarea" placeholder="Deskripsi produk" v-model="product.description"></textarea>
        </p>
      </div>
      <div class="field">
        <button class="button is-primary" @click="saveProduct">Simpan</button>
      </div>
    </div>

  </div>
</div>

</template>

<script>
  export default {
    data () {
      return {
        product: {
          'picture_url': '',
          name: '',
          description: '',
          'category_id': '',
          barcode: '',
          price: 0
        },
        onProcess: false,
        onError: false
      }
    },
    methods: {
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
          window.location.asssign('/admin/product')
        }).catch(err => {
          console.log(err)
        })
      }
    }
  }
</script>


<style lang="scss">
  .box-form {
    display: flex;
    width: 100% !important;
  }
</style>
