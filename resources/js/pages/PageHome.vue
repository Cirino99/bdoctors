<template>
  <div>
    <div class="d-flex justify-content-center flex-row mt-5">
      <!-- serchbar -->
      <form class="d-flex form-inline my-2 my-lg-0">
        <input v-model="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" @input="searchInput" @click="displayComponent" @keyup="displayComponent">
        <router-link :to="{name: 'AdvanceSearch', params: {specializationSelect: mySpecialization} }" class="btn btn-outline-primary my-2 my-sm-0">Search</router-link>
      </form>
    </div>
    <div class="d-flex justify-content-center" v-if="display" @mouseleave="handleFocusOut">
        <ul>
            <li v-for="specialization in specializations" :key="specialization.id" @click="selectSpecialization(specialization)">
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
        mySpecialization: null,
        doctors: [],
        specializations: [],
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
      selectSpecialization(specialization) {
        this.mySpecialization = specialization.id;
        this.search = specialization.name;
      },
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
