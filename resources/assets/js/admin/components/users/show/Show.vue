<template>
  <div>
    <breadcrumb />
    <div class="user-informations">
      <div class="user-informations__head">
        <h3 class="title is-4">Informasi User - #{{ user.id }}</h3>
      </div>
      <div class="user-informations__body">
        <div class="user-profie__image">
          <img :src="user.picture_urls.small" alt="">
        </div>
        <div class="user_informations__right">
          <p class="user__fullname">{{ user.name }}</p>
          <p class="user__email">{{ user.email }}</p>
          <p class="user__address">{{ user.address || '-' }}</p>
          <p class="user__address">{{ totalReview }} Review</p>
        </div>
      </div>
      <div class="user-reviews">
        <div class="user-review__head">
          <h4 class="is-title is-4">Reviews</h4>
        </div>
        <div class="user-review__body">
          <tableUserReview :reviews="reviews"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'

  const Breadcrumb = () => import('./Breadcrumb.vue')
  const TableUserReview = () => import('./TableUserReview.vue')

  export default {
    created () {
      this.getUsers()
      this.getUserReview()
    },
    mounted ()
    {},
    components: {
      Breadcrumb,
      TableUserReview
    },
    computed: {
      ...mapGetters([
        'users',
        'user'
      ]),
      totalReview () {
        if (this.reviews) {
          return this.reviews.length
        }
        return 0
      }
    },
    data () {
      return {
        reviews: []
      }
    },
    methods: {
      ...mapActions([
        'initUser'
      ]),
      getUsers () {
        const id = this.$route.params.id

        const indexUser = this.users.findIndex( x => id == x.id)

        this.initUser(this.users[indexUser])
      },
      getUserReview ()
      {
        this.$http.get(`api/user/${this.user.id}/review`).then(response => {
          console.log(response.data)
          this.reviews = response.data.reviews
        }).catch(err => err)
      }
    }
  }
</script>

