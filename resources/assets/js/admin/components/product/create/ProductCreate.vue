<template>
  <div>
    <div>
      <section class="section">
        <div class="container">
          <div class="columns">
            <div class="column">

            <input type="file" class="input" @change="_uploadImage">
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
              <label class="label">Category</label>
              <p class="control">
                <span class="select">
                  <select name="" v-model="product.category_id" class="select">
                    <option value="1">Uncategorized</option>
                  </select>
                </span>
                </p>
            </div>

            <div class="field">
              <label class="label">Message</label>
              <p class="control">
                <textarea class="textarea" placeholder="Textarea" v-model="product.description"></textarea>
              </p>
            </div>

            <div class="field">
              <button class="button is-primary" @click="saveProduct">Simpan</button>
            </div>

            </div>

          </div>
        </div>
      </section>
    </div>
    <div>
      <footer-apps></footer-apps>
    </div>
  </div>
</template>

<script>
  const FooterApps = () => import('otherComponents/Footer.vue')
  export default {
    data() {

      return {
        product: {
          picture_url: "",
          name: "",
          description: "-",
          category_id: "",
          barcode: ""
        }
      }
    },
    components: {
      FooterApps
    },
    methods: {
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
      saveProduct() {
        console.log("Ready to Post")
      }
    }
  }
</script>
