<template>
  <div class="request-topup">
    <div class="request-topup__head">
      <b>Permintaan Topup</b>
    </div>
    <div class="request-topup__body">
      <table class="table">
        <thead>
          <td></td>
          <td>Nama User</td>
          <td>Nominal</td>
        </thead>
        <tbody>
          <tr v-for="(item, $index) in topup.slice(0, 5)">
            <td>{{ $index + 1 }}</td>
            <td>{{ item.user.name }}</td>
            <td>{{ item.nominal_string }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style lang="scss" scoped>
  .request-topup__head {
    b {
      font-size: 0.85rem
    }
  }
</style>

<script>
  import { mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters([
        'topup'
      ])
    }
  }
</script>
