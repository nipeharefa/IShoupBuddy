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
        <li class="is-active"><a>Review</a></li>
      </ul>
    </nav>

    <div class="tabs">
      <ul>
        <li :class="{'is-active': tabs === 0}" @click="showTabs(0)"><a class="is-active">Semua Review</a></li>
        <li @click="showTabs(1)" :class="{'is-active': tabs === 1}"><a>Semua Report</a></li>
      </ul>
    </div>

    <div class="review_search__wrapper columns" v-if="tabs === 0">
      <div class="field column is-6 has-addons">
        <p class="control">
          <input class="input" type="text" placeholder="Find a Review" v-model="keyword">
        </p>
        <p class="control">
          <a class="button is-info">
            <i class="fa fa-search"></i>
          </a>
        </p>
      </div>
    </div>

    <div class="review__wrapper columns" v-if="tabs === 0">
      <review v-for="item in reviewFilterd" :review="item" :key="item.id" />
    </div>


    <div class="review_search__wrapper columns" v-if="tabs === 1">
      <div class="field column is-6">
        <p class="control">
        </p>
      </div>
    </div>

    <div class="review__wrapper columns" v-if="tabs === 1">
      <review v-for="item in reportReviews" :review="item" />
    </div>

  </div>
</template>


<script>
  import { mapGetters } from 'vuex'
  const Review = () => import('./Review.vue')
  export default {
    components: {
      Review
    },
    computed: {
      ...mapGetters([
        'reviews',
        'reportReviews'
      ]),
      cleanKeyword () {
        return this.keyword.replace(/[|&;$%@"<>()+,]/g, "")
      },
      reviewFilterd () {
        if (this.reviews) {
          return this.reviews.filter( x => {
            return x.body.includes(this.cleanKeyword)
          })
        }
        return null
      }
    },
    data () {
      return {
        keyword: "",
        tabs: 0
      }
    },
    methods: {
      showTabs (tabs) {
        this.tabs= tabs
      }
    }
  }
</script>
