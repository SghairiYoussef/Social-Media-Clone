<template>
    <div>
      <navBar/>
      <div class="container">
        <div class="row gutters">
          <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <ProfileCard :show-upload-button="true"/>
          </div>
          <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <EditForm/>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
  import navBar from '@/components/navbar.vue';
  import ProfileCard from '@/components/EditProfile/ProfileCard.vue';
  import EditForm from '@/components/EditProfile/EditForm.vue';

  export default {
    components: {
      navBar,
      ProfileCard,
      EditForm
    }
  }
  </script>

<style scoped>
.row {
  height: 840px;
}
</style>