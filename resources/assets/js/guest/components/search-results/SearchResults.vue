<template>
  <div >
    <div>
      <navbar-apps></navbar-apps>
    </div>
    <section>
      <div class="container">
        <div class="columns">
          <div class="column">
            <div class="search_result_head_total">
              <total-results :total="results.length"></total-results>
            </div>
            <div class="search_result_row">
              <results :products="results"></results>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div>
      <footer-apps></footer-apps>
    </div>
  </div>
</template>


<script>
  const FooterApps = () => import('otherComponents/Footer.vue')
  const NavbarApps = () => import('global/components/Navbars/GuestNavbar')
  const TotalResults = () => import('./HeadTotalResults.vue')
  const Results = () => import('./Results.vue')

  export default {
    mounted () {
      this.getSearchResult()
    },
    data () {
      return {
        keyword: window.katakunci,
        results: []
      }
    },
    components: {
      FooterApps,
      NavbarApps,
      TotalResults,
      Results
    },
    methods: {
      getSearchResult () {
        this.$http.get(`api/product?keyword=${this.keyword}`).then(response => {
          this.results = response.data.products
        })
      }
    }
  }
</script>
