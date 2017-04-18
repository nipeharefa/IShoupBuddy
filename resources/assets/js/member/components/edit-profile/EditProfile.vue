<template>
	<div>
    <navbar-apps-member></navbar-apps-member>
    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column">
            <div>
              <form-edit-profile></form-edit-profile>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>


<script>
  const FormEditProfile = () => import('./FormEditProfile')
  const NavbarAppsMember = () => import('otherComponents/Navbar-Member.vue')
  export default {
    mounted () {},
    components: {
      FormEditProfile,
      NavbarAppsMember
    }
  }
</script>
