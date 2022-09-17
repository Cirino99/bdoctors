<template>
  <div>
    <div class="d-flex justify-content-center flex-row mt-5">
      <!-- serchbar -->
      <form class="d-flex form-inline my-2 my-lg-0">
        <input v-model="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" @input="searchInput">
        <router-link :to="{name: 'AdvanceSearch', params: {specializationSelect: mySpecialization} }" class="btn btn-outline-primary my-2 my-sm-0">Search</router-link>
      </form>

      <div>
        <ul>
          <li v-for="specialization in specializations" :key="specialization.id" @click="selectSpecialization(specialization.name,specialization.id)">
            {{ specialization.name }}
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
        mySpecialization: "",
        doctors: [],
        specializations: []
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
            }
          });
    },

    methods: {
      searchInput() {
        if(this.search != ''){
            axios.get('/api/search/specialization?specialization=' + this.search)
        .then(res => {
          if (res.data.success) {
            this.specializations = res.data.result;
            console.log(this.specializations); 
          }
        });
        } else {
            this.specializations = [];
        }
       
      },

      selectSpecialization(specialization,id) {
        this.mySpecialization = id;
        this.search = specialization;
      }
    }
  }
</script>
  
<style>
  li:hover {
    background-color: aquamarine;
  }
</style>
