<template>
  <aside class="menu">
    <p class="menu-label">
      General
    </p>
    <ul class="menu-list">
      <li><a>Dashboard</a></li>
      <li>
        <router-link :to="{ name: 'product-index' }" append>Products</router-link>
      </li>
      <!-- <li>
        <router-link :to="{ name: 'review-index' }" append>Review</router-link>
      </li> -->
    </ul>
  </aside>
</template>
