<template>
  <div class="dazzle">
    <nav class="breadcrumb">
      <ul>
        <li><a href="/">Halaman Depan</a></li>
        <li>
          <router-link :to="{ name: 'dashboard' }" append>
            Administrator
          </router-link>
        </li>
        <li>
          <router-link :to="{ name: 'listUser' }" append class="is-active">
            User
          </router-link>
        </li>
      </ul>
    </nav>
    <table-user></table-user>
  </div>
</template>


<script>
  const TableUser = () => import ('./TableUser.vue')
  export default {
    components: {
      TableUser
    }
  }
</script>
