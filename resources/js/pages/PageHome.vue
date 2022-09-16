<template>
  <div>
    <div class="d-flex justify-content-center mt-5">
      <!-- serchbar -->
      <form class="d-flex form-inline my-2 my-lg-0">
        <input @click="displayComponent" @focusout="handleFocusOut" v-model="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
    <div class="d-flex justify-content-center" v-if="display">
      <ul>
        <!-- <li v-for="specialization in spec.specializations" :key="specialization.id">
          {{ specialization }}
        </li> -->
        <li v-for="specialization in filteredSpecialization" :key="specialization.id">
          {{ specialization.name }}
        </li>
      </ul>
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
        spec: [],

        display: false
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

    // methods: {
    //   searchInput() {
    //     this.search.foreach(result => {
    //       result.specializations.toLowerCase().includes(this.search.toLowerCase())
    //     })
    //   }
    // }
    computed: {
      filteredSpecialization() {
        return this.spec.filter(specialization => 
          specialization.name.toLowerCase().includes(this.search.toLowerCase()))
      }
    },

    methods: {
        displayComponent() {
          this.display = true;
        },

        handleFocusOut() {
          this.display = false;
        }
    }
  }
</script>
  
<style>
  li:hover {
    background-color: aquamarine;
  }
</style>
