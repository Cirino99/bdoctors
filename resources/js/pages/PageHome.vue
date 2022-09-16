<template>
  <div>
    <div class="d-flex justify-content-center mt-5">
      <form class="d-flex form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>

    <div class="mt-5">
      <div>
        <h3>
          MEDICI SPONSORIZZATI
        </h3>
      </div>
      <div class="d-flex justify-content-center"> 
          <CardDoctor v-for="(doctor, index) in doctors" :key="index" :doctor="doctor"/>
      </div>
      <div class="mt-5">
        <h2>
          PERCHÉ SCEGLIERCI
        </h2>
      </div>
    </div>
  </div>
</template>
  
<script>

import CardDoctor from '../components/CardDoctor.vue'

  export default {
    name: 'Home',

    data() {
      return {
        doctors: [],
      }
    },

    components: {
        CardDoctor,
    },

    created() {
      axios.get('/api/doctors')
        .then(res => {
            if (res.data.success) {
              this.doctors = res.data.result;
              console.log(this.doctors);
            }
          })
    }
  }
</script>
  
<style>
  
</style>