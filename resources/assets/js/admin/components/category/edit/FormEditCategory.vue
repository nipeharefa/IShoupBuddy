<template>
  <div class="f_add_product">
    <div class="column is-half">
      <div class="bantu">
        <div class="field">
          <figure class="media-left">
            <p class="image is-64x64">
              <label for="uploadCategory">
                <img :src="generateLinkImage(category.picture_url)">
              </label>
              <input type="file" name="" id="uploadCategory"
              @change="_uploadImage" accept="image/*" style="visibility:hidden">
            </p>
          </figure>
        </div>

        <div class="field">
          <p class="control">
            <input type="text" class="input" placeholder="Nama Kategori"
            v-model="category.name" autocomplete="off" />
          </p>
        </div>

      </div>

      <div class="">

        <div class="field">
          <a class="button is-primary" @click="saveCategory($event)">Simpan</a>
        </div>

      </div>

    </div>
  </div>
</template>

<style lang="scss" scoped>
  .bantu {
    display: flex;
    flex-direction: row;
  }
</style>

<script>
  import { mapActions, mapGetters } from 'vuex'
  import iziToast from 'izitoast'
  export default {
    created() {
      this.getCategory()
    },
    data () {
      return {
        indexC: null
      }
    },
    computed: {
      ...mapGetters([
        'categories',
        'category',
      ])
    },
    methods: {
      ...mapActions([
        'initCategory'
      ]),
      generateLinkImage (filename) {
        if (filename) {
          return window.location.origin + '/image/small/' + filename
        }
        return 'http://bulma.io/images/placeholders/128x128.png'
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
          this.category.pictureUrl = response.data.image
        }).catch(error => {
          return error
        })
      },
      getCategory () {
        const id = this.$route.params.id
        const indexCategory = this.categories.findIndex( x => id == x.id)
        this.initCategory(this.categories[indexCategory])
        this.indexC = indexCategory
      },
      saveCategory (event) {
        const data = this.category
        const a = event.target
        a.classList.add('is-loading')
        this.$http.put(`/api/category/${data.id}`, data).then(response => {
          console.log(response.data)
          this.$router.push({name: 'listCategory'})
          a.classList.remove('is-loading')
          iziToast.success({
              title: 'Sukses',
              message: `Kategori Berhasil diperbaharui`,
              position: 'bottomRight'
          })
        }).catch(err => {
          a.classList.remove('is-loading')
        })
      }
    }
  }
</script>
