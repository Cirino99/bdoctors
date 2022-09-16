<template>
  <div>
    <div class="d-flex justify-content-center mt-5">
      <!-- serchbar -->
      <form class="d-flex form-inline my-2 my-lg-0">
        <input v-model="searching" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
      </form>
      <!-- debug per vedere l'array -->
      <div v-for="specialization in specializations" :key="specialization">
        <p>{{ specialization }}</p>
      </div>

    </div>

    <div class="mt-5">
      <div>
        <h3>
          MEDICI SPONSORIZZATI
        </h3>
      </div>
      <div class="d-flex justify-content-center"> 
        <!-- card singolo dottore -->
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

        // array temporaneo per le specializzazioni
        specializations: [
          "Pediatria",
          "Chirurgia",
          "Radiologia",
          "Neurochirurgia"
        ],

        searching : ""

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
    },

    methods: {
      searchMovie() {
        axios.get('/api/doctors')
          .then(result => {
            this.doctors = result.data.results;
            console.log(this.doctors);
          })
      }
    }
  }
</script>
  
<style>

</style>