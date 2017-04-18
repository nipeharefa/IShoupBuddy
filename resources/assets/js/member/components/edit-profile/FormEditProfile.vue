<template>

  <div class="form-update-profile">

    <div class="field">
      <div class="change-image">
        <img src="http://lorempixel.com/64/64/people/">
        <button class="button is-primary">Ganti Foto</button>
      </div>
    </div>
    <div class="field">
      <label class="label">Name</label>
      <p class="control">
        <input class="input" type="text" placeholder="Alex Fergusen">
      </p>
    </div>

    <div class="field">
      <label class="label">Email</label>
      <p class="control">
        <input class="input" type="email" placeholder="johndoe@gmail.com">
      </p>


    </div>

    <div class="field">
      <label class="label">Telepon</label>
      <p class="control">
        <input class="input" type="email" placeholder="+6282276121xx">
      </p>
    </div>

    <div class="field">
      <label class="label">Alamat</label>
      <p class="control">
        <textarea class="textarea" placeholder="Jalan THamrin No. 114 Medan"></textarea>
      </p>
    </div>

    <div class="field has-text-centered">
      <button class="button is-primary is-fullwidth">Update Profile</button>
    </div>

    <div class="field has-text-centered">
      <a href="" class="link is-link is-danger">Batal</a>
    </div>
  </div>

</template>


<script>
  export default {

  }
</script>

