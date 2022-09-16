<template>
  <div>
    <div class="d-flex justify-content-center mt-5">
      <!-- serchbar -->
      <form class="d-flex form-inline my-2 my-lg-0">
        <input v-model="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        <div>
          {{ search }}
        </div>
      </form>

      <div>
        <ul>
          <li v-for="specialization in spec.specializations" :key="specialization.id">
            {{ specialization.result }}
          </li>
        </ul>
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

        search: "",

        // array per il dottori 
        doctors: [],

        // array per le specializzazioni
        spec: []
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
              // this.specializations = res.data.specializations;
              // console.log(this.doctors);
              // console.log(this.specializations);
            }
          });
      axios.get('/api/search/specialization')
        .then(res => {
          if (res.data.success) {
            this.spec = res.data.result;
            console.log(this.spec); 
          }
        });
    },

    methods: {
      searchInput() {
        this.search.foreach(result => {
          result.specializations.toLowerCase().includes(this.search.toLowerCase())
        })
      }
    }
  }
</script>
  
<style>
  
</style>
