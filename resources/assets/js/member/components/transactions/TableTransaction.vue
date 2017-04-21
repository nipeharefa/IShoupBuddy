<template>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th><abbr title="Position">ID</abbr></th>
          <th><abbr title="Position">Nama Produk</abbr></th>
          <th><abbr title="Position">Nominal</abbr></th>
          <th><abbr title="Position">Status</abbr></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in 5">
          <td class="item-id-transaction">
            <a href="/me/transactions/0000011">00011</a>
          </td>
          <td>Sayur Putih Pertamax</td>
          <td>100.000</td>
          <td>
            <span class="tag is-success">
              <i class="fa fa-check-circle"></i>
            </span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
