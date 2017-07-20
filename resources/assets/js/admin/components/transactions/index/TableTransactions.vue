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
        <li class="is-active"><a>Transaction</a></li>
      </ul>
    </nav>
    <table class="table">
      <thead>
        <tr>
          <th>ID Transaksi</th>
          <th>User</th>
          <th>Nominal</th>
          <th>Type</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in transactionsSorted">
          <td>
            <router-link
            :to="{ name: 'detailTransaction', params: { id: item.id }}" append>
              #{{ item.id }}
            </router-link>
          </td>
          <td>
            {{ item.user.id }}
          </td>
          <td>
            {{ item.nominal_string }}
          </td>
          <td>
            {{ item.type }}
          </td>
          <td>
            {{ item.status_string }}
          </td>
          <td>
            <a class="button is-small is-primary" @click="approve(item)"
            :disabled="item.status === 1 ? 'disabled' : false">Approve</a>
            <a class="button is-small is-danger"
            :disabled="item.status === 1 ? 'disabled' : false">Cancel</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<script>
  import { mapGetters } from 'vuex'
  export default {
    computed: {
      ...mapGetters([
        'transactions'
      ]),
      transactionsSorted () {
        const sortedProduct =  this.transactions.sort( (a,b) => {
          var nameA = a.total_review
          var nameB = b.total_review
          if (nameA > nameB) {
            return -1;
          }
          if (nameA < nameB) {
            return 1;
          }

          // names must be equal
          return 0;
        })

        return sortedProduct
      }
    },
    methods: {
      approve (item) {
        if (item.status === 1) {
          return
        }
        this.approveSaldo(item)
        return
      },
      approveSaldo (item) {
        this.$http.post(`api/admin/transaction/${item.id}/approve`).then(response => {
          const { data } = response
          console.log(data)
        }).catch(err => err)
      },
      approveTransBiasa (item) {
        console.log(item)
      }
    }
  }
</script>
