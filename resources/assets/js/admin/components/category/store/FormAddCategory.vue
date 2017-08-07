<template>
  <div class="f_add_product">
    <div class="column is-half">
      <div class="bantu">
        <div class="field">
          <figure class="media-left">
            <p class="image is-64x64">
              <label for="uploadCategory">
                <img :src="generateLinkImage(category.pictureUrl)">
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
  import { mapActions } from 'vuex'
  import iziToast from 'izitoast'

  export default {
    data () {
      return {
        category: {
          name: '',
          pictureUrl: ''
        }
      }
    },
    methods: {
      ...mapActions([
        'addCategory'
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

        console.log(fileName)
      },
      saveCategory () {
        const data = this.category
        const a = event.target
        a.classList.add('is-loading')
        this.$http.post('api/admin/category', data).then(response => {
          const data = response.data
          this.addCategory(data)
          this.$router.push({name: 'listCategory'})
          a.classList.remove('is-loading')
          iziToast.success({
              title: 'Sukses',
              message: `Kategori Berhasil ditambahkan`,
              position: 'bottomRight'
          })
        }).catch(err => {
          a.classList.remove('is-loading')
        })
      }
    }
  }
</script>
